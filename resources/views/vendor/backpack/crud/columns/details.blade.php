

@if(count($entry->{$column['name']}))
    <a href="/admin/project-detail?project_id={{$entry->id}}">
        <span class="badge badge-warning">{{count($entry->{$column['name']})}}</span>
    </a>
@endif
