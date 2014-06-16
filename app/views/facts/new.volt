
<form method="post" action="{{ url("facts/create") }}">

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("facts", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ submit_button("Save", "class": "btn btn-success") }}
    </li>
</ul>

{{ content() }}

<div class="center scaffold">
    <h2>Add Fact</h2>

    <div class="clearfix">
        <label for="url">Url</label>
        {{ form.render("url") }}
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
