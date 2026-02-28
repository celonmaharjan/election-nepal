# 🕷️ Web Scraping Masterclass (Basic to Advanced)

How to extract data from any corner of the web.

---

## 🟢 Level 1: Static HTML Parsing
**Use Case:** Old websites, Wikipedia, Blogs.
*   **Concept:** Download the HTML and find tags using "Selectors."
*   **Example (PHP):**
    ```php
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $tables = $dom->getElementsByTagName('table');
    // Loop through rows and get text
    ```
*   **Pros:** Easy to write.
*   **Cons:** Breaks if the site changes its design even slightly.

---

## 🟡 Level 2: Reverse Engineering APIs
**Use Case:** Modern React/Vue sites (like `knowyourcandidate.live`).
*   **Concept:** Don't scrape the HTML. Find the JSON source the site uses to talk to its database.
*   **Discovery:**
    1. Open Chrome DevTools -> Network.
    2. Filter by `XHR/Fetch`.
    3. Find URLs ending in `/api/` or `.json`.
*   **Pros:** Instant, structured data, much less work.
*   **Cons:** APIs are often hidden or require "Tokens."

---

## 🟠 Level 3: Headless Browsing
**Use Case:** Sites that require scrolling, logging in, or clicking buttons.
*   **Concept:** Run a "ghost" browser (Puppeteer or Playwright). It acts like a human.
*   **Logic:** `browser.goto('site.com')` -> `page.click('.show-more')` -> `page.content()`.
*   **Pros:** Can scrape 99% of sites.
*   **Cons:** Very slow and uses a lot of RAM.

---

## 🔴 Level 4: Bypassing Blocks
**Use Case:** Amazon, LinkedIn, Government Portals.
*   **Identity Faking:** Change your `User-Agent` string to look like a random iPhone or Windows PC.
*   **Referrer Spoofing:** Make it look like you came from Google.
*   **Residential Proxies:** Use real home IP addresses so the site doesn't realize you are a server in a data center.
*   **Rate Limiting:** Put `sleep(1)` in your code so you don't send 100 requests in 1 second.

---

## 🕵️ How I Scraped this Project:
1.  **Recon:** I checked the site and saw it was a React app (no data in HTML).
2.  **Forensics:** I scanned their JavaScript files for the keyword "candidates."
3.  **The Leak:** I found their internal endpoint: `https://.../api/candidates`.
4.  **Automation:** I built a Laravel command to loop through 35 pages of JSON data.
