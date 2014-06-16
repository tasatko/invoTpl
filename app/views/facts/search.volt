{{ content() }}

<ul class="pager">
    <li class="pull-right">
        {{ link_to("facts/new", "Create facts", "class": "btn btn-primary") }}
    </li>
</ul>

{% for fact in page.items %}
{% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Lang</th>
            <th>Url</th>
            <th>Text</th>
        </tr>
    </thead>
{% endif %}
    <tbody>
        <tr>
            <td>{{ fact.id }}</td>
            <td>{{ fact.lang }}</td>
            <td>{{ fact.url }}</td>
            <td>{{ fact.text }}</td>
            <td width="12%" style="text-align: center;">{{ link_to("facts/edit/" ~ fact.id, '<i class="icon-pencil"></i> Edit', "class": "btn btn-primary") }}</td>
            <td width="12%" style="text-align: center;">{{ link_to("facts/delete/" ~ fact.id, '<i class="icon-remove"></i> Delete', "class": "btn btn-danger") }}</td>
        </tr>
    </tbody>
{% if loop.last %}
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("facts/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("facts/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn ") }}
                    {{ link_to("facts/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("facts/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
{% endif %}
{% else %}
    No facts are recorded
{% endfor %}
