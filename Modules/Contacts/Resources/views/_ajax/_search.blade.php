{!! Form::open(['route' => 'contacts.search']) !!}
<div class="input-group content-group m-b-20">
	<div class="contact-search">
		<input type="text" class="form-control input-sm typeahead" placeholder="Start typing contact name" value="{{ old('search') }}" name="search">
		
	</div>
	<div class="input-group-btn">
		<button type="submit" class="btn btn-info btn-sm">@icon('solid/search') @langapp('search') </button>
	</div>
</div>

{!! Form::close() !!}