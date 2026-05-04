@php echo '<!DOCTYPE html>'; @endphp
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mietvertrag #{{ $contract->id }}</title>
    <link rel="stylesheet" href="{{ asset('css/contract/contract-preview.css') }}">
</head>
<body>

<button class="print-btn" onclick="window.print()">🖨️ Drucken / PDF</button>

<h1>MIETVERTRAG</h1>
<div class="subtitle">Vertragsnummer: #{{ $contract->id }} &nbsp;|&nbsp; Erstellt
    am: {{ $contract->created_at->format('d.m.Y') }}</div>

<h2>1. Vertragsparteien</h2>
<div class="parties">
    <div class="party">
        <div class="party-label">VERMIETER</div>
        <strong>Muster Immobilien GmbH</strong><br>
        Musterstraße 1<br>
        10115 Berlin<br>
        Tel: +49 30 123456<br>
        info@muster-immobilien.de
    </div>
    <div class="party">
        <div class="party-label">MIETER</div>
        <strong>{{ $contract->interestedPerson->full_name }}</strong><br>
        {{ $contract->interestedPerson->street_address }}<br>
        {{ $contract->interestedPerson->postal_code }} {{ $contract->interestedPerson->city }}<br>
        {{ $contract->interestedPerson->phone }}<br>
        {{ $contract->interestedPerson->email }}
    </div>
</div>

<h2>2. Mietobjekt</h2>
<table>
    <tr>
        <td>Bezeichnung</td>
        <td>{{ $contract->apartment->title }}</td>
    </tr>
    <tr>
        <td>Adresse</td>
        <td>{{ $contract->apartment->street_address }}
            , {{ $contract->apartment->postal_code }} {{ $contract->apartment->city }}</td>
    </tr>
    <tr>
        <td>Etage</td>
        <td>{{ $contract->apartment->floor ?? '—' }}</td>
    </tr>
    <tr>
        <td>Zimmer</td>
        <td>{{ $contract->apartment->rooms }}</td>
    </tr>
    <tr>
        <td>Wohnfläche</td>
        <td>{{ $contract->apartment->size_sqm }} m²</td>
    </tr>
    <tr>
        <td>Baujahr</td>
        <td>{{ $contract->apartment->year_built ?? '—' }}</td>
    </tr>
</table>

<h2>3. Mietdauer</h2>
<table>
    <tr>
        <td>Mietbeginn</td>
        <td>{{ $contract->start_date->format('d.m.Y') }}</td>
    </tr>
    <tr>
        <td>Mietende</td>
        <td>{{ $contract->end_date ? $contract->end_date->format('d.m.Y') : 'Unbefristet' }}</td>
    </tr>
</table>

<h2>4. Mietzins</h2>
<table>
    <tr>
        <td>Kaltmiete</td>
        <td>{{ number_format($contract->apartment->rent_cold, 2, ',', '.') }} €</td>
    </tr>
    <tr>
        <td>Warmmiete</td>
        <td>{{ number_format($contract->apartment->rent_warm, 2, ',', '.') }} €</td>
    </tr>
    <tr>
        <td>Kaution</td>
        <td>{{ number_format($contract->apartment->deposit, 2, ',', '.') }} €</td>
    </tr>
</table>

<h2 class="page-break">5. Allgemeine Bestimmungen</h2>
<p>Der Mieter verpflichtet sich, die Miete monatlich im Voraus bis zum 3. Werktag des jeweiligen Monats auf das Konto
    des Vermieters zu überweisen.</p>
<p>Die Wohnung ist ausschließlich zu Wohnzwecken zu nutzen. Eine gewerbliche Nutzung oder Untervermietung bedarf der
    schriftlichen Zustimmung des Vermieters.</p>
<p>Der Mieter hat die Wohnung pfleglich zu behandeln und bei Auszug in ordnungsgemäßem Zustand zurückzugeben.</p>
<p>Für Schäden, die durch unsachgemäße Nutzung entstehen, haftet der Mieter.</p>

@if($contract->notes)
    <h2>6. Zusätzliche Vereinbarungen</h2>
    <p>{{ $contract->notes }}</p>
@endif

<div class="signature-row">
    <div class="signature-box">
        Berlin, den ___________________<br><br>
        <strong>Vermieter</strong><br>
        Muster Immobilien GmbH
    </div>
    <div class="signature-box">
        _________________, den ___________________<br><br>
        <strong>Mieter</strong><br>
        {{ $contract->interestedPerson->full_name }}
    </div>
</div>

</body>
</html>
