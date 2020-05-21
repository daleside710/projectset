<!-- Widget: Social Buttons - Grid-->
<aside class="widget widget--sidebar widget-social widget-social--grid">
    <a href="https://www.instagram.com/casinoxbonuses/" class="btn-social-counter btn-social-counter--instagram"
       target="_blank">
        <div class="btn-social-counter__icon">
            <i class="fab fa-instagram"></i>
        </div>
        <h6 class="btn-social-counter__title">Følg oss!</h6>
        <span class="btn-social-counter__count"><span
                    class="btn-social-counter__count-num">59,2k</span> Følgere</span>
        <span class="btn-social-counter__add-icon"></span>
    </a>
    @auth()
        <a href="{{route('ChatQueries')}}" class="btn-social-counter btn-social-counter--instagram">
            <div class="btn-social-counter__icon">
                <i class="fab fa fa-comment-alt"></i>
            </div>
            <h6 class="btn-social-counter__title">Message</h6>

        </a>
    @endauth

</aside>
<!-- Widget: Social Buttons - Grid / End -->
