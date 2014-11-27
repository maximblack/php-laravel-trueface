<div class="row">
    <div class="column small-12 content-block">
        <div class="row">
            <div class="columns large-6">
                <h4>
                    Привет, <span class="notice">{{Auth::user()->name}}</span>!
                </h4>
            </div>
            <div class="columns large-6 column-info">
                Последний визит: <span class="notice">{{Auth::user()->updated_at}}</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="column small-12">
                <ul class="large-block-grid-3 dashboard-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-thumb-tack"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>