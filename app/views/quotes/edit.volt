
<form method="post" action="{{ url("quotes/save") }}">

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
    <h2>Edit quotes</h2>

    {{ form.render("id") }}

    <div class="clearfix">
        <label for="url">Url</label>
        {{ form.render("url") }}
    </div>

    <div class="clearfix">
            <label for="text">Author</label>
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

    </form>
</div>
