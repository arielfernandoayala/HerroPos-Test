            <div class="content-wrapper">



          <section class="content">

            <div id="map2" style="width: 100%; height: 600px;"></div>
            
          </section>

          <?php
          $latYlong = $_GET["latitudYlongitud"];
          echo $latYlong;
          ?>

          <script type="text/javascript">
             
              var marker;          //variable del marcador
              var coords = {};    //coordenadas obtenidas con la geolocalización
              let params = new URLSearchParams(location.search);
              var latitudYlongitud = params.get('latitudYlongitud');
              var arrayLatYLong = latitudYlongitud.split(',');

              console.log("lat y long: ",arrayLatYLong);
               
              //Funcion principal
              initMap = function () 
              {


               
                  //usamos la API para geolocalizar el usuario
                      navigator.geolocation.getCurrentPosition(
                        function (position){
                          coords =  {
                            lng: arrayLatYLong[1],
                            lat: arrayLatYLong[0]
                          };
                          console.log("coord",coords);
                          setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa         
                         
                        },function(error){console.log(error);});
                  
              }
               
               
               
              function setMapa (coords)
              {   
                    //Se crea una nueva instancia del objeto mapa
                    var div = document.getElementById("map2");
                    var map = new google.maps.Map(div,
                    {
                      zoom: 13,
                      center:new google.maps.LatLng(coords.lat,coords.lng),
               
                    });
               
                    //Creamos el marcador en el mapa con sus propiedades
                    //para nuestro obetivo tenemos que poner el atributo draggable en true
                    //position pondremos las mismas coordenas que obtuvimos en la geolocalización
                    marker = new google.maps.Marker({
                      map: map,
                      draggable: true,
                      animation: google.maps.Animation.DROP,
                      position: new google.maps.LatLng(coords.lat,coords.lng),
               
                    });

                    
                    //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
                    //cuando el usuario a soltado el marcador
                    marker.addListener('click', toggleBounce);
                    
                    marker.addListener( 'dragend', function (event)
                    {

                      //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                      document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
                    });

              }
               
              //callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
              function toggleBounce() {
                if (marker.getAnimation() !== null) {
                  marker.setAnimation(null);
                } else {
                  marker.setAnimation(google.maps.Animation.BOUNCE);
                }
              }

              window.onload=initMap;

          </script>

        </div>