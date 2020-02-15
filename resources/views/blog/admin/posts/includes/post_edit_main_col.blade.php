@php
/**@var \App\Models\BlogPost @item */
@endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Published
                @else
                    Draft
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                    <div class="card-subtitle mb-2 text-muted"></div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Basic Data</a>
                        </li>
                        <li class="nav-item">
                            <a href="#adddata" class="nav-link" data-toggle="tab" role="tab">Extra Data</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane active" id="maindata" role="tabpanel">
                            <div class="form-group">
                                <label for="title">Header</label>
                                <input type="text" name="title" value="{{ $item->title }}" id="title" class="form-control" minlength="3">
                            </div>
                            <div class="form-group">
                                <label for="content_raw">Post</label>
                                <textarea name="content_raw" id="content_raw"  rows="20" class="form-control">{{ old('content_raw',$item->content_raw) }}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane" id="adddata" role="tabpanel">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control" placeholder="Choose category">
                                    @foreach($categoryList as $categoryOption)
                                        <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id == $item->category_id) selected @endif>
                                            {{ $categoryOption->id_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="slug">identity</label>
                                <input type="text" name="slug" value="{{ $item->slug }}" id="slug" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="excerpt">Excerpt</label>
                                <textarea name="excerpt" id="excerpt"  rows="3" class="form-control">{{ old('excerpt',$item->excerpt) }}</textarea>
                            </div>

                            <div class="form-check">
                                <input type="hidden" name="is_published" value="0">
                                <input type="checkbox" name="is_published" class="form-check-input" value="1" @if($item->is_published) checked="checked" @endif>
                                <label for="is_published" class="form-check-label">Published</label>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
