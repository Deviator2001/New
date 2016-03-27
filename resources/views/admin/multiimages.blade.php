<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <div class="imageUploadMultiple" data-target="{{ route('admin.formitems.image.uploadImage') }}" data-token="{{ csrf_token() }}">
        <div class="row form-group images-group">
            <?php $i=0 ?>
            @foreach ($value as $image)
                <div class="col-xs-6 col-md-3 imageThumbnail">
                    <div class="thumbnail">
                        <img style="width: 300px; height: 300px;" data-value="{{ $image }}" src="{{ URL::to($image) }}" />
                        <a href="#" class="imageRemove">Удалить</a>
                    </div>
                    <label for="imgtitle[]">Title</label>
                    <input class="form-control" name="imgtitle[]" type="text" value="@if(isset($instance->attaches[$i])) {{$instance->attaches[$i]->title}} @else {{ Request::old("imgtitle")[$i]}} @endif">
                    <label for="imgalt[]">Alt</label>
                    <input class="form-control" name="imgalt[]" type="text" value="@if(isset($instance->attaches[$i])) {{$instance->attaches[$i]->alt}} @else {{ Request::old("imgalt")[$i]}} @endif">
                    <label for="imgdesc[]">Описание</label>
                    <input class="form-control" name="imgdesc[]" type="text" value="@if(isset($instance->attaches[$i])) {{$instance->attaches[$i]->desc}} @else {{ Request::old("imgdesc")[$i]}} @endif">
                </div>
                <?php $i++ ?>
            @endforeach
        </div>
        <div>
            <div class="btn btn-primary imageBrowse"><i class="fa fa-upload"></i> {{ trans('admin::lang.image.browseMultiple') }}</div>
        </div>
        <input name="{{ $name }}" class="imageValue" type="hidden" value="{{ implode(',', $value) }}">
        <div class="errors">
            @include(AdminTemplate::view('formitem.errors'))
        </div>
    </div>
</div>