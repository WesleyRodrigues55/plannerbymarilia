const mp = new MercadoPago("APP_USR-f964ed73-450d-4da4-a131-26f229b0489b");

(async function getIdentificationTypes() {
    try {
        const identificationTypes = await mp.getIdentificationTypes();
        const identificationTypeElement = document.getElementById('form-checkout__identificationType');

        createSelectOptions(identificationTypeElement, identificationTypes);
    } catch (e) {
        return console.error('Error getting identificationTypes: ', e);
    }
})();

function createSelectOptions(elem, options, labelsAndKeys = { label: "name", value: "id" }) {
    const { label, value } = labelsAndKeys;

    elem.options.length = 0;

    const tempOptions = document.createDocumentFragment();

    options.forEach(option => {
        const optValue = option[value];
        const optLabel = option[label];

        const opt = document.createElement('option');
        opt.value = optValue;
        opt.textContent = optLabel;

        tempOptions.appendChild(opt);
    });

    elem.appendChild(tempOptions);
}