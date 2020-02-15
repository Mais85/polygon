@php  /**@var \App\Models\BlogCategory $item */ @endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary">Yadda saxla</button>
            </div>
        </div>
    </div>
</div>
@if($item->exists)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>ID:{{ $item->id }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Yaradilib</label>
                        <input type="text" value="{{ $item->created_at }}" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="title">Son deyisiklik</label>
                        <input type="text" value="{{ $item->updated_at }}" class="form-control"/>
                    </div><div class="form-group">
                        <label for="title">Silinib</label>
                        <input type="text" value="{{ $item->delete_at }}" class="form-control"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
