<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Finanzielle Details</h3>
    </div>
    <div class="card-body">
        <table class="table table-sm">
            <tr>
                <td class="text-muted">Kaltmiete:</td>
                <td class="text-end">
                    <strong>{{ number_format($apartment->rent_cold, 2) }} €</strong>
                </td>
            </tr>
            <tr>
                <td class="text-muted">Nebenkosten:</td>
                <td class="text-end">
                    <strong>{{ number_format($apartment->rent_warm - $apartment->rent_cold, 2) }} €</strong>
                </td>
            </tr>
            <tr class="table-active">
                <td><strong>Warmmiete:</strong></td>
                <td class="text-end">
                    <strong class="text-primary">{{ number_format($apartment->rent_warm, 2) }} €</strong>
                </td>
            </tr>
            <tr>
                <td class="text-muted">Kaution:</td>
                <td class="text-end">
                    <strong>{{ number_format($apartment->deposit, 2) }} €</strong>
                </td>
            </tr>
        </table>
    </div>
</div>
