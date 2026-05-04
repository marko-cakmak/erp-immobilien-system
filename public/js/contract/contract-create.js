document.addEventListener('DOMContentLoaded', function () {

    const apartmentId = document.getElementById('apartmentId');

    apartmentId.addEventListener('change', function () {
        const id = this.value;

        if (!id) {
            clearRentFields();
            clearPersonSelection();
            return;
        }

        const selectedData = window._lastSelectedApartment;

        if (selectedData) {
            document.getElementById('rentCold').value = selectedData.rent_cold ?? '';
            document.getElementById('rentWarm').value = selectedData.rent_warm ?? '';
            document.getElementById('deposit').value = selectedData.deposit ?? '';
        }

        fetch(`/contracts/apartment/${id}/persons`, {
            headers: {'Accept': 'application/json'}
        })
            .then(res => res.json())
            .then(person => {
                if (person && person.first_name) {
                    selectPerson(person.id, `${person.first_name} ${person.last_name}`);
                }
            })
            .catch(err => console.error('Person fetch error:', err));
    });

    function clearRentFields() {
        document.getElementById('rentCold').value = '';
        document.getElementById('rentWarm').value = '';
        document.getElementById('deposit').value = '';
    }

    function clearPersonSelection() {
        document.getElementById('personId').value = '';
        document.getElementById('personSearchInput').value = '';
        document.getElementById('personResults').innerHTML = '';
        document.getElementById('selectedPersonBox').style.display = 'none';
    }

});
