class ProvinciaController  {
    constructor () {

    }

    renderResult = (provincias) => {
        provincias.forEach(provincia => {
            let html = `<option value="${provincia.id_provincia}">${provincia.nombre}</option>`;
            $("#provinciaSelect").append(html);
        });

    }
    getList = () => {
        const url = "src/controller/ProvinciaController.php?action=getListado"
        fetch(url, {
            method: 'GET',                
            headers:{
                'Content-Type': 'application/json'
            }
            }).then(res => res.json())
            .catch(error => console.error('Error:', error))
            .then(response => {
                console.log('Success:', response)
                this.renderResult(response.data);
            });
    };
    init = () => {
        this.getList()
    }
}

$(function () {
    const provinciaController = new ProvinciaController();
    provinciaController.init();
});