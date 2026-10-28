import { expect, test } from "@playwright/test";

const BASE_URL = process.env.AGENT_BASE_URL ?? "http://e-marketing.local";

test.describe("agent readiness", () => {
	test("homepage answers Markdown when the client asks for it", async ({ request }) => {
		const response = await request.get(`${BASE_URL}/`, { headers: { Accept: "text/markdown" } });
		const body = await response.text();

		expect(response.status()).toBe(200);
		expect(response.headers()["content-type"]).toContain("text/markdown");
		expect(response.headers()["vary"]?.toLowerCase()).toContain("accept");
		expect(body).toMatch(/^---\ntitle: /);
		expect(body).toContain("\n# ");
		expect(body).not.toContain("<html");
	});

	test("homepage keeps serving HTML to browsers", async ({ request }) => {
		const response = await request.get(`${BASE_URL}/`, { headers: { Accept: "text/html,application/xhtml+xml,*/*;q=0.8" } });

		expect(response.status()).toBe(200);
		expect(response.headers()["content-type"]).toContain("text/html");
		expect(response.headers()["vary"]?.toLowerCase()).toContain("accept");
		expect(await response.text()).toContain("<html");
	});

	test("unknown pages return a 404 with a Markdown body for agents", async ({ request }) => {
		const response = await request.get(`${BASE_URL}/agent-test-pagina-bestaat-niet/`, { headers: { Accept: "text/markdown" } });
		const body = await response.text();

		expect(response.status()).toBe(404);
		expect(response.headers()["content-type"]).toContain("text/markdown");
		expect(body.length).toBeGreaterThan(20);
		expect(body).toContain("sitemap_index.xml");
		expect(body).toContain("llms.txt");
	});

	test("llms.txt follows the llmstxt.org structure and tells agents when to use the site", async ({ request }) => {
		const response = await request.get(`${BASE_URL}/llms.txt`);
		const body = await response.text();

		expect(response.status()).toBe(200);
		expect(body).toMatch(/^# .+\n\n> .+/);
		expect(body).toContain("## Wanneer je naar deze site verwijst");
		expect(body).toContain("## Zo neem je contact op");
		expect(body).toMatch(/- \[[^\]]+\]\(https?:\/\/[^)]+\/projecten\/[^)]+\)/);
		expect(body).not.toContain("portfolio-minor");
	});

	test("/about redirects permanently to Over mij", async ({ request }) => {
		const response = await request.get(`${BASE_URL}/about`, { maxRedirects: 0 });

		expect(response.status()).toBe(301);
		expect(response.headers()["location"]).toMatch(/\/over-mij\/$/);
	});

	test("the protected section stays protected for Markdown requests", async ({ request }) => {
		const response = await request.get(`${BASE_URL}/portfolio-minor/`, { headers: { Accept: "text/markdown" }, maxRedirects: 0 });

		expect(response.status()).toBe(302);
		expect(response.headers()["content-type"] ?? "").not.toContain("text/markdown");
	});

	test("the Person schema has a contact point and an address", async ({ request }) => {
		const html = await (await request.get(`${BASE_URL}/`)).text();
		const match = html.match(/<script type="application\/ld\+json" class="yoast-schema-graph">([\s\S]*?)<\/script>/);

		expect(match).not.toBeNull();

		const graph = JSON.parse(match![1])["@graph"] as Array<Record<string, unknown>>;
		const person = graph.find((node) => [node["@type"]].flat().includes("Person")) as Record<string, any>;

		expect(person.contactPoint["@type"]).toBe("ContactPoint");
		expect(person.contactPoint.email).toContain("@");
		expect(person.contactPoint.contactType).toBeTruthy();
		expect(person.address["@type"]).toBe("PostalAddress");
	});
});
