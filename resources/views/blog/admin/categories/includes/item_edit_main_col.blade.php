@php  /**@var \App\Models\BlogCategory $item */ @endphp
@php  /**@var \Illuminate\Support\Collection $categorylist */ @endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Əsas məlumatlar</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane active" id="maindata" role="tabpanel">
                            <div class="form-group">
                                <label for="title">Basliq</label>
                                <input name="title"  value="{{ $item->title }}"
                                      id="title"
                                       type="text"
                                       class="form-control"
                                       minlength="3"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="slug">Identifikator</label>
                                <input type="text" name="slug" value="{{ $item->slug }}"
                                   id="slug"
                                   class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="paren_id">Ana Kateqoriya</label>
                                <select name="parent_id" id="parent_id"
                                         class="form-control"
                                         placeholder="Kateqoriya secin" required>
                                    @foreach($categoryList as $categoryoption)
                                        <option value="{{ $categoryoption->id }}" @if($categoryoption->id == $item->parent_id) selected @endif>
                                              {{-- {{ $categoryoption->id }}. {{ $categoryoption->title }} --}}
                                            {{ $categoryoption->id_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Mundericat</label>
                                <textarea name="description" id="description" rows="3" class="form-control">{{old('description',$item->description)}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
