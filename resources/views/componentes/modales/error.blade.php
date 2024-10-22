<div class="text-center m-4">
    {{--  <h5 class="offcanvas-title " id="offcanvasExampleLabel">¿Estás seguro que deseas eliminar el periodo? --}}
     </h5>
 </div>
 <div class="text-center">
     <div class="position-relative p-5 text-center">
         <i class="fas fa-question" style="
         font-size: 40px;
     "></i>
         <h1 class="text-body-emphasis">{{$mensaje}}</h1>
         <p class="col-lg-6 mx-auto mb-4">
         {{$solucion}}
         </p>

        <button class="btn btn-outline-dark" data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">
         Cerrar
       </button></div>
 </div>
