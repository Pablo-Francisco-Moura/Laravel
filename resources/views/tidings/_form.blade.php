<div class="row">
    <div class="col-md-4">
        {!!Form::text('manchete', "Manchete: ")->required()!!}
    </div>
    <div class="col-md-4">
        {!!Form::text('title_tiding', "Título da Notícia: ")->required()!!}
    </div>
    <div class="col-md-4">
        {!!Form::textarea('description_tiding', "Descrição da Notícia: ")->required()!!}
    </div>
    <div class="col-md-12">
    <button type="submit" class="btn btn-primary"> ENVIAR </button>
    </div>
</div>