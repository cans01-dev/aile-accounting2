<x-layout>
  <x-breadcrumb grandparent="マスタ設定" parent="外貨換算関連マスタ">
    <a class="bdcb bdcb-child active">事業セグメントマスタ</a>
    <a class="bdcb bdcb-child">開示セグメントマスタ</a>
    <a class="bdcb bdcb-child">会社-事業 セグメント紐づけマスタ</a>
    <a class="bdcb bdcb-child">セグメント報告集計対象マスタ</a>
  </x-breadcrumb>
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createModal">新規作成</button>
  </div>
  <table class="table table-bordered border-secondary w-auto">
    <thead>
      <tr class="table-lightblue">
        <th>ID</th>
        <th>事業セグメント名称</th>
        <th>開示セグメント</th>
        <th>有効/利用不可</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($businesses as $business)
        <tr>
          <td>{{ $business->id }}</td>
          <td>{{ $business->title }}</td>
          <td>{{ $business->disclosed_business_list->title }}</td>
          <td>
            @if ($business->enabled)
              有効
            @else
              利用不可
            @endif
          </td>
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $business->id }}"
            delete-action="/master/businesses/{{ $business->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  
  @foreach ($businesses as $business)
    <x-modal id="editModal{{ $business->id }}" title="編集">
      <form action="/master/businesses/{{ $business->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">事業セグメント名称</label>
          <input type="text" name="title" value="{{ $business->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">開示セグメント</label>
          <select class="form-select" name="disclosed_business_list_id">
            @foreach ($lists as $list)
              <option value="{{ $list->id }}" @selected($list->id == $business->disclosed_business_list_id)>{{ $list->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">有効/利用不可</label>
          <x-enabled :enabled="$business->enabled" />
        </div>  
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach
  <x-modal id="createModal" title="新規作成">
    <form action="/master/businesses" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">事業セグメント名称</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">開示セグメント</label>
        <select class="form-select" name="disclosed_business_list_id">
          @foreach ($lists as $list)
            <option value="{{ $list->id }}">{{ $list->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">有効/利用不可</label>
        <x-enabled />
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>