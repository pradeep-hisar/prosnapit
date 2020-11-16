<!-- Order Number -->
<div class="form-group {{ $errors->has('monthlyrent') ? ' has-error' : '' }}">
   <label for="monthlyrent" class="col-md-3 control-label">{{ trans('Monthly Rent') }}</label>
   <div class="col-md-7 col-sm-12">
       <input class="form-control" type="text" name="monthlyrent" aria-label="monthlyrent" id="monthlyrent" value="{{ old('monthlyrent', $item->monthlyrent) }}" />
       {!! $errors->first('monthlyrent', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
   </div>
</div>
