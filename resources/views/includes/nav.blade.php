
                        <nav class="navbar p-0">
                            <div class="header-menu m-auto position-static">
                                <ul class="menu">
                                   <li  class="{{(request()->is('/')) ? 'active' : '' }}"><a href="/">Home </a></li>
                                   <li  class="{{(request()->is('categories/public-relations')) ? 'active' : '' }}"><a href="/categories/public-relations">Public Relations </a></li>
                                   <li class="{{(request()->is('categories/story-telling')) ? 'active' : '' }}"><a href="/categories/story-telling">⁠Story telling</a></li>
                                   <li class="{{(request()->is('categories/voix-global-communications')) ? 'active' : '' }}"><a href="/categories/voix-global-communications">⁠ Voix Global Communications</a></li>
                                   <li class="{{(request()->is('/categories/learn-a-language')) ? 'active' : '' }}" ><a href="/categories/learn-a-language">⁠Learn a new language</a></li>


                                       <li class="{{(request()->is('categories/voix-global-communications')) ? 'active' : '' }}"><a href="#!">More</a>
                                        <ul>
                                               <li class="{{(request()->is('categories/globe-trotter')) ? 'active' : '' }}"><a href="/categories/globe-trotter">⁠Globe trotter</a></li>
                      <li class="{{(request()->is('categories/trends-insight')) ? 'active' : '' }}"><a href="/categories/trends-insight">⁠⁠Trends & Insight</a></li>
                                            <li><a href="/categories/others">⁠Others</a></li>
                                        </ul>
                                    </li>


                                    <li><a href="/">contact</a></li>
                                </ul>
                            </div>
                            <div class="right-part">
                                <ul class="d-flex justify-content-end">
                                    <li><a href="#!"><i class="flaticon-facebook-2"></i></a></li>
                                    <li><a href="#!" class="active"><i class="flaticon-twitter-1"></i></a></li>
                                    <li><a href="#!"><i class="flaticon-skype"></i></a></li>
                                    <li><a href="#!"><i class="flaticon-instagram-2"></i></a></li>
                                </ul>
                            </div>
                        </nav>



