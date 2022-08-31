<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nom">@lang('Nom')</label>
                    <input type="text" class="form-control input-solid" id="nom"
                           name="sender_nom" placeholder="@lang('Nom')" value="{{ $edit ? $client->nom : old('nom')  }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prenom">@lang('Prenom')</label>
                    <input type="text" class="form-control input-solid" id="prenom"
                           name="sender_prenom" placeholder="@lang('Prenom')" value="{{ $edit ? $client->prenom : old('prenom') }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="phone">@lang('Téléphone')</label>
            <input type="text" class="form-control input-solid" id="phone"
                   name="sender_tel" placeholder="@lang('Téléphone')" value="{{ $edit ? $client->tel : old('tel') }}">
        </div>
    </div>
</div>

