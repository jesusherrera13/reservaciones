<style type="text/css">
     .js-example-basic-single {
          width: 100%;
     }
</style>

<div class="container">
     <div class="row">
          <div class="col-sm-4">
               <select data-placeholder="Seleccione el destino" class="js-example-basic-single" tabindex="2">
                    <option value=""></option>
                    @foreach($destinos as $row)
                         <option value="{{ $row->id }}">{{ $row->localidad }}</option>
                    @endforeach
               </select>
          </div>
          <div class="col-sm-4">
               <input type="text" name="dates" class="form-control form-control-sm pull-right">
          </div>
     </div>
</div>