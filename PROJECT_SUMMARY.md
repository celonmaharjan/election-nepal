# 🗳️ Nepal General Election 2026 - Project Summary

## 1. Overview
A production-ready, high-performance web portal built to provide transparency and information for the upcoming Nepal House of Representatives election on March 5, 2026.

## 2. Tech Stack
- **Framework:** Laravel 12 (PHP 8.4)
- **Database:** PostgreSQL (for robust relational data and case-insensitive searching)
- **UI:** Tailwind CSS + Alpine.js (for high-end interactivity)
- **Admin Panel:** Laravel Filament v3 (Professional CRUD and dashboard)
- **Search:** Laravel Scout + Database Engine (optimized with `ILIKE` for case-insensitivity)
- **SEO:** Artesaos/SEOTools + Spatie Sitemap

## 3. Key Features Implemented
### 📍 Data Integrity & Scraping
- **Real MP Data:** Imported all 165 real MPs from the 2022 election via Wikipedia scraping.
- **API Discovery:** Reverse-engineered the `knowyourcandidate.live` internal API to sync 3,400+ candidates and their metadata.
- **Dynamic Normalization:** Built a "Learning Pipeline" that maps messy inputs (like "एम.ए.") to standardized categories using an Alias Database.

### 💎 Premium User Experience
- **"Google-Style" UI:** Redesigned candidate profiles with high-contrast circular frames and party badges.
- **Search-as-you-type:** A custom high-performance comparison tool that handles 3,000+ records with zero lag.
- **Image Resilience:** Implemented intelligent fallbacks. If a government or Wikipedia photo fails to load, the site instantly displays a professional, colored initial badge.

### 🌍 Localization
- **Bi-lingual:** Full English and Nepali support via a session-based locale switcher.
- **Script Handling:** Support for both Devanagari and Latin scripts in names and descriptions.

## 4. Database Schema Highlights
- **Hierarchical Structure:** Provinces -> Districts -> Constituencies -> Candidates.
- **Normalization:** Dedicated `parties` table to prevent duplication and ensure every candidate is correctly affiliated.
- **Aliases:** A `data_aliases` table that allows the system to "learn" new synonyms without touching code.

## 5. Deployment Readiness
- **Security:** Hidden admin entry, verified `is_incumbent` logic, and production-safe `.env` structures.
- **SEO Ready:** Canonical tags, XML Sitemaps, and JSON-LD Schema already live.
