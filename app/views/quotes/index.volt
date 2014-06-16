<p>
    <h2>Quotes</h2>
</p>

{{ content() }}

<div align="right">
    {{ link_to("quotes/new", "Create Quote", "class": "btn btn-primary") }}
</div>

<br />

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <td>id</td>
            <td>quote</td>
            <td>author</td>
            <td>url</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>51001</td>
            <td>Friðrik Þór Friðriksson</td>
            <td>http://en.wikipedia.org/wiki/Ernest_P._Worrell</td>
            <td class="text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Action <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                  </ul>
                </div>
            </td>
        </tr>
        <tr>
            <td>51002</td>
            <td>Keith Carradine</td>
            <td>http://en.wikipedia.org/wiki/Bear</td>
            <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                Action <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Edit</a></li>
                                <li><a href="#">Delete</a></li>
                              </ul>
                            </div>
                        </td>
        </tr>
        <tr>
            <td>51003</td>
            <td>Nico Engelbrecht</td>
            <td>http://en.wikipedia.org/wiki/Nature</td>
            <td class="text-center">
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                Action <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Edit</a></li>
                                <li><a href="#">Delete</a></li>
                              </ul>
                            </div>
                        </td>
        </tr>
    </tbody>
</table>
