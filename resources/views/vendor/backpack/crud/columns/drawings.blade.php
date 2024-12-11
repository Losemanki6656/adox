

@if(count($entry->{$column['name']}))
    <a href="/admin/drawing?project_id={{$entry->id}}">
        <span class="badge badge-success">{{count($entry->{$column['name']})}}</span>
    </a>
@endif
