document.addEventListener('DOMContentLoaded', () => {
    const enterpriseDropdown = document.getElementById('enterprise-dropdown');
    const metersDropdown = document.getElementById('meter-dropdown');
    const readingsTableBody = document.querySelector('#readings-table-body');
    const accumulatedConsumptionLabel = document.getElementById('accumulatedConsumption-label');
    const waterPressureLabel = document.getElementById('waterPressure-label');

    function loadReadingsEnterprise(meterIds) {
        const fetchPromises = meterIds.map(id =>
            fetch(getReadingsUrl + '?meterID=' + id)
                .then(response => response.json())
        );

        // tipo um "for" para um metodo async que é o fetch do ajax
        Promise.all(fetchPromises)
            .then(results => {
                // Flatten the array of arrays
                const allReadings = results.flat();

                // Clear table rows
                readingsTableBody.innerHTML = '';
                if (allReadings.length === 0) {
                    readingsTableBody.innerHTML =
                        `<tr><td colspan="4" class="text-muted text-center">Sem leituras.</td></tr>`;
                    return;
                }

                allConsumption = 0;
                averagePressureTotal = 0;
                averagePressureQuantity = 0;
                // Insert readings into table
                allReadings.forEach(r => {
                    allConsumption += parseInt(r.accumulatedConsumption, 10);
                    averagePressureTotal += parseInt(r.waterPressure, 10);
                    readingsTableBody.insertAdjacentHTML('beforeend', `
                    <tr>
                        <td>${r.id} ${r.wasFix ? `<i class="fas fa-wrench ms-2"></i>` : ``}</td>
                        <td>${r.value} m³</td>
                        <td>${r.readingDate}</td>  
                        <td> 
                            <button class="btn btn-outline-primary btn-sm fw-semibold shadow-sm"
                                    style="transition: all 0.2s ease-in-out;"
                                    onmouseover="this.style.transform='scale(1.05)';"
                                    onmouseout="this.style.transform='scale(1)';"
                                    onclick="window.location.href='?id=${r.id}'">
                                Ver Detalhes
                            </button>
                        </td>
                    </tr>
                `);
                });

                averagePressure = averagePressureTotal / allReadings.length;
                averagePressure = averagePressure.toFixed(2);
                accumulatedConsumptionLabel.innerHTML = allConsumption;
                waterPressureLabel.innerHTML = averagePressure;
            })
            .catch(err => console.error('Error loading readings:', err));
    }

    enterpriseDropdown.addEventListener('change', function () {
        const enterpriseId = this.value;

        // Clear existing items
        metersDropdown.innerHTML = '<option>Carregando...</option>';

        // Yii-generated URL
        fetch(getMetersUrl + '?enterpriseID=' + enterpriseId)
            .then(response => response.json())
            .then(data => {
                const meterIds = [];

                // Clear existing options
                metersDropdown.innerHTML = '';

                // Add placeholder
                metersDropdown.insertAdjacentHTML('beforeend',
                    `<option value="">Selecione um contador</option>`
                );

                // Insert the meters
                data.forEach(meter => {
                    meterIds.push(meter.id);
                    metersDropdown.insertAdjacentHTML('beforeend',
                        `<option value="${meter.id}">${meter.name}</option>`
                    );
                });

                loadReadingsEnterprise(meterIds);
            })
            .catch(err => console.error('Error loading meters:', err));
    });

    metersDropdown.addEventListener('change', function () {
        const meterId = this.value;
        if (!meterId) return;

        fetch(getReadingsUrl + '?meterID=' + meterId)
            .then(response => response.json())
            .then(readings => {
                // Clear table rows
                readingsTableBody.innerHTML = '';

                if (readings.length === 0) {
                    readingsTableBody.innerHTML =
                        `<tr><td colspan="4" class="text-muted text-center">Sem leituras.</td></tr>`;
                    return;
                }

                allConsumption = 0;
                averagePressureTotal = 0;
                averagePressureQuantity = 0;
                // Insert readings into table
                readings.forEach(r => {
                    allConsumption += parseInt(r.accumulatedConsumption, 10);
                    averagePressureTotal += parseInt(r.waterPressure, 10);
                    readingsTableBody.insertAdjacentHTML('beforeend', `
                    <tr>
                        <td>${r.id} ${r.wasFix ? `<i class="fas fa-wrench ms-2"></i>` : ``}</td>
                        <td>${r.value} m³</td>
                        <td>${r.readingDate}</td>
                        <td> 
                            <button class="btn btn-outline-primary btn-sm fw-semibold shadow-sm"
                                    style="transition: all 0.2s ease-in-out;"
                                    onmouseover="this.style.transform='scale(1.05)';"
                                    onmouseout="this.style.transform='scale(1)';"
                                    onclick="window.location.href='?id=${r.id}'">
                                Ver Detalhes
                            </button>
                        </td>
                    </tr>
                `);
                });

                averagePressure = averagePressureTotal / readings.length;
                averagePressure = averagePressure.toFixed(2);
                accumulatedConsumptionLabel.innerHTML = allConsumption;
                waterPressureLabel.innerHTML = averagePressure;
            });
    });
});


