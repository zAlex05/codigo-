<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>	

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> 


    <script>
     $(document).on("click","#btn_publicar",()=>{

         const user=$("#pub_usuario").val();
         const desc=$("#pub_descripcion").val();
         const estado=$("#pub_estado").val();

         $.ajax({
         	url:'acciones_publicaciones.php',
         	data:{user:user,desc:desc,estado:estado},
         	type:'POST',
         	dataType:'json',
         	success:(data)=>{
         		console.log(data);

                $("#aux_id").val(data[0].pub_id);

                $("#estado").text(data[0].pub_estado);
                $("#publicacion").text(data[0].pub_descripcion);
                if(data[0].pub_estado=='Alegre'){
                   $(".cont_publicacion").removeClass("bg-secondary");
                   $(".cont_publicacion").removeClass("bg-primary");
                   $(".cont_publicacion").addClass("bg-warning");
                }
                if(data[0].pub_estado=='Triste'){
                   $(".cont_publicacion").removeClass("bg-warning");
                   $(".cont_publicacion").removeClass("bg-primary");
                   $(".cont_publicacion").addClass("bg-secondary");
                }

                if(data[0].pub_estado=='Molesto'){
                   $(".cont_publicacion").removeClass("bg-warning");
                   $(".cont_publicacion").removeClass("bg-secondary");
                   $(".cont_publicacion").addClass("bg-primary");
                }

         	},error:(desc,estado)=>{
                //500 401 404 200
                alert("Un error ha sucedido"+estado);
            },
         })

     });
    </script>
</head>
<body>
	<h1>VN Book</h1>
    <h4>Perfil Alex Montatixe</h4>

	<div class="container">

      <div class="row">
      	<div class="col-md-6">
      		<input type="text" id="pub_usuario" placeholder="Usuario" class="form-control">
      		<textarea  id="pub_descripcion" rows="2" class="form-control"></textarea>
      		<select id="pub_estado" class="form-control bg-dark">
      			<option value="">Elija una Opcion</option>
      			<option value="Alegre">Alegre</option>
      			<option value="Triste">Triste</option>
      			<option value="Molesto">Molesto</option>
      		</select>
      		<div class="d-grid gap-2">
      			<button class="btn btn-primary" id="btn_publicar" >Publicar</button>
      		</div>
      	</div>
      	<div class="col-md-6">
          
          <div id="pub_img" class="dropzone"></div>
          <input type="hidden" id="aux_id" >

      	</div>
      </div>

    <div class="row">
        <div class="col-md-4">


        <div class="card cont_publicacion"  style="width: 13rem;">
              <img src="no_image.png" class="card-img-top" id="aux_img" alt="...">
              <div class="card-body">
                    <h3 id="estado">Estado</h3>
                <p class="card-text" id="publicacion" >Descripcion</p>
            </div>
        </div>

        </div>
    </div>



	</div>
</body>
</html>
<script>


new Dropzone("#pub_img", {

    url: 'acciones_publicaciones.php',
    dictDefaultMessage: 'Arrastre el archivo aquí o haga clic para cargar', // Establezca la declaración de solicitud predeterminada
    paramName: "file", // El nombre del parámetro pasado al fondo
    init: function () {

        this.on("sending", function(file, xhr, formData){
            formData.append("aux_id",$("#aux_id").val() );
        });

        this.on("success", function (file, data) {
            $("#aux_img").attr('src',`img/${data}`)
        });
    }
});





</script>
