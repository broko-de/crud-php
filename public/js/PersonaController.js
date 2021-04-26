class PersonaController  {
    constructor () {

    }
    
    renderResult = (personas) => {
        $("#resultadosTabla").empty();
        personas.forEach(persona => {
            let html = `<tr>
                            <td>${persona.id_persona}</td>
                            <td>${persona.apellido}</td>
                            <td>${persona.nombre}</td>
                            <td>${persona.provincia}</td>
                            <td>
                                <button type="button" class="btn btn-outline-warning editPersona" data-idpersona="${persona.id_persona}"><i class="fas fa-pencil-alt"></i></button>
                                <button type="button" class="btn btn-outline-danger deletePersona" data-idpersona="${persona.id_persona}" data-nombrepersona="${persona.nombre} ${persona.apellido}"><i class="fas fa-trash"></i></button>                            
                            </td>
                        </tr>`;    
            $("#resultadosTabla").append(html);
        });

    }
    getList = () => {
        const url = "src/controller/PersonaController.php?action=getList"
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json'
        }).done((resp)=>{
            if(resp.status=="Ok"){   
                console.log('Success:', resp);
                const p = new PersonaController();     
                p.renderResult(resp.data);
            }else{
                alert("Se produjo un error");
            }
        });        
    };

    save = () => {   
        $("#formPersona").submit(function(e){
            e.preventDefault();
            let data = {};
            if($("#id_persona").val()==''){
                data = {action:"save",nombre:$("#nombreInput").val(),apellido:$("#apellidoInput").val(),provincia:$("#provinciaSelect").val()};
            }else{
                data = {action:"update",id_persona:$("#id_persona").val(),nombre:$("#nombreInput").val(),apellido:$("#apellidoInput").val(),provincia:$("#provinciaSelect").val()};
            }
            $.ajax({
                type: "POST",
                url: "src/controller/PersonaController.php",
                data: data,
                dataType: 'json'
            }).done((resp)=>{
                if(resp.status=="Ok"){   
                    $("#alertSuccessMsg").html(resp.message);
                    $("#alertSuccess").show();                    
                    const p = new PersonaController();     
                    p.getList();
                    $("#personaModal").modal('hide')
                    $("#formPersona").trigger("reset");
                }else{
                    alert("No se pudo guardar los datos");
                }
                
            });
        });
    }

    update = () => {
        $(document).on("click",".editPersona",function(){            
            let url = `src/controller/PersonaController.php?action=get&id_persona=${$(this).data('idpersona')}`
            $.ajax({
                type: "GET",
                url: url,
                dataType: 'json'
            }).done((resp)=>{
                if(resp.status=="Ok"){   
                    let persona = resp.data
                    $("#nombreInput").val(persona.nombre);
                    $("#apellidoInput").val(persona.apellido);
                    $("#id_persona").val(persona.id_persona);
                    $("#provinciaSelect").val(persona.id_provincia);
                    $("#personaModal").modal('show')
                }else{
                    alert("Se produjo un error");
                }
            });
        });
    }

    delete = () => {
        $(document).on("click",".deletePersona",function(){            
            $("#idPersonaDelete").val($(this).data('idpersona'));
            $("#nombreEliminar").html($(this).data('nombrepersona'));
            $("#deletePersonaModal").modal('show')
        });
    }

    deleteConfirm = () => {
        $("#formDeletePersona").submit(function(e){
            e.preventDefault();
            let id = $("#idPersonaDelete").val();
            $.ajax({
                type: "POST",
                url: "src/controller/PersonaController.php",
                data : {action:"delete",id_persona:id},
                dataType: 'json'
            }).done((resp)=>{
                if(resp.status=="Ok"){   
                    $("#alertSuccessMsg").html(resp.message);
                    $("#alertSuccess").show();                    
                    const p = new PersonaController();     
                    p.getList();
                    $("#deletePersonaModal").modal('hide')
                }else{
                    alert("No se pudo eliminar la persona");
                }
                
            });
        });
    }

    init = () => {
        this.getList();
        this.save();
        this.update();
        this.delete();
        this.deleteConfirm();
    };
    
};

$(function () {
    const personaController = new PersonaController();
    personaController.init();
    $("#alertSuccess").hide();                    

});
