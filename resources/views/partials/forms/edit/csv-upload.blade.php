<!-- Order Number -->
<div class="form-group {{ $errors->has('user_import_csv') ? ' has-error' : '' }}">
   <label for="user_import_csv" class="col-md-3 control-label">{{ trans('user_import_csv') }}</label>
   <div class="col-md-7 col-sm-12">
       <input class="form-control" type="file" name="user_import_csv" aria-label="user_import_csv" id="user_import_csv" value="{{ old('user_import_csv', $item->user_import_csv) }}" />
       {!! $errors->first('user_import_csv', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
   </div>
</div>
