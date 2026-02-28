# 🧹 Data Sanitization & Normalization Guide

"Garbage In, Garbage Out." This guide explains how to ensure your data is clean.

---

## 🟢 Level 1: Basic String Cleaning
Standardizing the raw text.
*   **Trimming:** Removing hidden spaces.
*   **Encoding:** Converting characters like `&amp;` to `&`.
*   **Slugification:** Converting "Balen Shah" to "balen-shah" for clean URLs.
*   **Case Normalization:** Making everything lowercase for easier comparison.

---

## 🟡 Level 2: The Alias Database (The Election Project Method)
**Use Case:** When one thing has many names (e.g., "MA", "Master", "एम.ए").
*   **The System:** A database table that maps messy names to a single "Standard Name."
*   **Code Implementation:**
    ```php
    $standard = DataAlias::resolve($messyString, 'education');
    ```
*   **Why it's better:** You never have to touch your code again. You just add a new row to the database.

---

## 🟠 Level 3: Fuzzy Matching (Algorithm Based)
**Use Case:** Handling typos (e.g., "Gagan Thapa" vs "Gagan Thapaa").
*   **Levenshtein Distance:** Measures how many letters you need to change to make two words identical.
*   **Logic:** If the score is > 85%, assume they are the same person.
*   **Tools:** PHP `levenshtein()` function.

---

## 🔴 Level 4: Semantic Embeddings (Vector Search)
**Use Case:** Million-row datasets where words look different but mean the same.
*   **Vectorization:** Converting "Cetamol" and "Paracetamol" into mathematical coordinates.
*   **The Math:** AI sees that these words occupy the same "space" in human knowledge.
*   **The Result:** Perfect accuracy for synonyms without needing an alias list.

---

## 🟣 Expert Level: The Hybrid Pipeline
The best systems use all of the above:
1.  **Lookup Table:** First, check if we already have a rule.
2.  **Fuzzy Match:** If not, check if it's a typo of an existing record.
3.  **LLM/AI:** If still unknown, send the row to an AI (like Gemini) to categorize it.
4.  **Self-Learning:** Once the AI categorizes it, save that result back into the **Lookup Table** so you never have to ask the AI again.
