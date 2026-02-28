# 🔍 The Ultimate SEO Guide (Basic to Advanced)

This guide explains how we optimized the Nepal Election portal to rank #1 on Google.

---

## 🟢 Level 1: The Basics (On-Page Tags)
These are the non-negotiables for any website.
*   **Dynamic Title Tags:** Every candidate needs a unique title (e.g., "KP Oli - Candidate Profile | Nepal Election").
*   **Meta Descriptions:** Short summaries (150 chars) that appear under your link in search results.
*   **H1-H3 Hierarchy:** Using proper header tags tells Google what the most important text is.

---

## 🟡 Level 2: Social & Trust (OpenGraph & Canonical)
*   **OpenGraph (OG):** Tags that control how your site looks when shared on Facebook or WhatsApp. We added images, titles, and site names.
*   **Canonical Tags:** We added `<link rel="canonical" href="...">` to every page. This prevents "Duplicate Content" penalties if the same page is accessed via different URLs.
*   **Sitemap.xml:** A robot-readable map of your site. We automated this to include all 3,500+ candidates so Google finds them instantly.

---

## 🟠 Level 3: Semantic SEO (JSON-LD Schema)
This is where you go from "text" to "data."
*   **The Method:** We added a `<script type="application/ld+json">` block.
*   **Why:** Instead of Google just seeing "KP Oli" as text, the schema tells Google: *"This is a Person, their job is Candidate, and they belong to this Party."*
*   **The Result:** This enables "Rich Snippets" (stars, boxes, and cards) directly in Google search results.

---

## 🔴 Level 4: Technical & Performance SEO
*   **Referrer Policies:** We added `referrerpolicy="no-referrer"` to external images. This ensures images from government or Wikipedia sites load without being blocked.
*   **Minification:** Compressing CSS and JS (done via Vite) to make the site load in under 1 second.
*   **Alt Tags:** Every candidate photo has an `alt` tag with their name, helping the site appear in Google Image Search.

---

## 🏆 Advanced Strategy: Topical Authority
In this project, we built "Topical Authority" by linking related entities:
*   **Candidate -> Party:** Google sees you have deep data on the party.
*   **Candidate -> Constituency:** Google sees you have deep data on the location.
By cross-linking these, Google treats your site as an "Expert" on the topic of the Nepal Election.
