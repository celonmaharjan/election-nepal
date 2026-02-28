@props(['candidate' => null, 'party' => null])

@if($candidate)
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Person",
  "name": "{{ $candidate->name }}",
  "jobTitle": "Political Candidate",
  "affiliation": {
    "@@type": "Organization",
    "name": "{{ $candidate->party->name ?? 'Independent' }}"
  },
  "address": {
    "@@type": "PostalAddress",
    "addressLocality": "{{ $candidate->constituency->district ?? '' }}"
  }
}
</script>
@endif

@if($party)
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Organization",
  "name": "{{ $party->name }}",
  "alternateName": "{{ $party->abbreviation }}",
  "foundingDate": "{{ $party->founded_year }}",
  "description": "{{ $party->description }}"
}
</script>
@endif
