<!-- Order Number -->
<div class="form-group {{ $errors->has('configuration') ? ' has-error' : '' }}">
   <label for="configuration" class="col-md-3 control-label">{{ trans('Configuration') }}</label>
   <div class="col-md-7 col-sm-12">
       <input class="form-control" type="text" name="configuration" aria-label="configuration" id="configuration" value="{{ old('configuration', $item->configuration) }}" />
       {!! $errors->first('configuration', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
   </div>
</div>
