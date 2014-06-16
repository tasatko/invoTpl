{{ content() }}

<ul class="pager">
    <li class="pull-right">
        {{ link_to("quotes/new", "Create quote", "class": "btn btn-primary") }}
    </li>
</ul>

{% for quote in page.items %}
{% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Lang</th>
            <th>Url</th>
            <th>Author</th>
            <th>Text</th>
        </tr>
    </thead>
{% endif %}
    <tbody>
        <tr>
            <td>{{ quote.id }}</td>
            <td>{{ quote.lang }}</td>
            <td>{{ quote.url }}</td>
            <td>{{ quote.author }}</td>
            <td>{{ quote.text }}</td>
            <td width="12%" style="text-align: center;">{{ link_to("quotes/edit/" ~ quote.id, '<i class="icon-pencil"></i> Edit', "class": "btn btn-primary") }}</td>
            <td width="12%" style="text-align: center;">{{ link_to("quotes/delete/" ~ quote.id, '<i class="icon-remove"></i> Delete', "class": "btn btn-danger") }}</td>
        </tr>
    </tbody>
{% if loop.last %}
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("quotes/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("quotes/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn ") }}
                    {{ link_to("quotes/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("quotes/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
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
