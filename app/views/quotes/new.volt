
<form method="post" action="{{ url("quotes/create") }}">

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("quotes", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ submit_button("Save", "class": "btn btn-success") }}
    </li>
</ul>

{{ content() }}

<div class="center scaffold">
    <h2>Add Quote</h2>

    <div class="clearfix">
        <label for="url">Url</label>
        {{ form.render("url") }}
    </div>

        <div class="clearfix">
            <label for="lang">Author</label>
            {{ form.render("author") }}
        </div>

    <div class="clearfix">
        <label for="lang">Lang</label>
        {{ form.render("lang") }}
    </div>

    <div class="clearfix">
            <label for="text">Text</label>
            {{ form.render("text") }}
    </div>

</div>
</form>
