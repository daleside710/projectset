@extends('backend.layouts.master')
@section('title','å gjøre')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 app-sidebar">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#newTaskModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            New Task
                        </button>
                    </div>
                    <div class="app-sidebar-menu">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item active d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail mr-2 width-15 height-15"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                All
                            </a>
                            <a href="#" class="list-group-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send mr-2 width-15 height-15"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                My Task
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0">Tags</h6>
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item d-flex align-items-center">
                                <span class="text-warning fa fa-circle mr-2"></span>
                                Theme Support
                                <span class="small ml-auto">5</span>
                            </a>
                            <a href="#" class="list-group-item d-flex align-items-center">
                                <span class="text-success fa fa-circle mr-2"></span>
                                Freelance
                            </a>
                            <a href="#" class="list-group-item d-flex align-items-center">
                                <span class="text-danger fa fa-circle mr-2"></span>
                                Social
                            </a>
                            <a href="#" class="list-group-item d-flex align-items-center">
                                <span class="text-info fa fa-circle mr-2"></span>
                                Friends
                            </a>
                            <a href="#" class="list-group-item d-flex align-items-center">
                                <span class="text-secondary fa fa-circle mr-2"></span>
                                Coding
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 app-content">
                <div class="app-content-overlay"></div>
                <div class="app-action">
                    <div class="action-left">
                        <ul class="list-inline">
                            <li class="list-inline-item mb-0">
                                <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                    Filter
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Favourites</a>
                                    <a class="dropdown-item" href="#">Done</a>
                                    <a class="dropdown-item" href="#">Deleted</a>
                                </div>
                            </li>
                            <li class="list-inline-item mb-0">
                                <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                    Sort
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Ascending</a>
                                    <a class="dropdown-item" href="#">Descending</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="action-right">
                        <form class="d-flex mr-3">
                            <a href="#" class="app-sidebar-menu-button btn btn-outline-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu width-15 height-15"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                            </a>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Task search" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-light" type="button" id="button-addon1">
                                        <i class="ti-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="app-pager d-flex align-items-center">
                            <div class="mr-3">1-50 of 253</div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left width-15 height-15"><polyline points="15 18 9 12 15 6"></polyline></svg>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right width-15 height-15"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="card card-body app-content-body">
                    <div class="app-lists">
                        <ul class="list-group list-group-flush ui-sortable">
                            <li class="list-group-item task-list active">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                                        <label class="custom-control-label" for="customCheck1"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star-o font-size-16"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">How To Protect Your Computer Very Useful Tips
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-danger">Social</div>
                                            </div>
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="avatar-group">
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Lisle Essam">
                                                        <img src="assets/media/image/user/women_avatar2.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Baxie Roseblade">
                                                        <img src="assets/media/image/user/man_avatar5.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Mella Mixter">
                                                        <img src="assets/media/image/user/women_avatar1.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Jo Hugill">
                                                        <img src="assets/media/image/user/man_avatar1.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Cullie Philcott">
                                                        <img src="assets/media/image/user/women_avatar5.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item task-list active">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
                                        <label class="custom-control-label" for="customCheck2"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star font-size-16 text-warning"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">How Hypnosis Can Help You
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-warning">Theme Support</div>
                                            </div>
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="avatar-group">
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Baxie Roseblade">
                                                        <img src="assets/media/image/user/man_avatar5.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Mella Mixter">
                                                        <img src="assets/media/image/user/women_avatar1.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Jo Hugill">
                                                        <img src="assets/media/image/user/man_avatar1.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Cullie Philcott">
                                                        <img src="assets/media/image/user/women_avatar5.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item task-list">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star font-size-16 text-warning"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">Dealing With Technical Support 10 Useful Tips
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-info">Friends</div>
                                            </div>
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="avatar-group">
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Polly Everist">
                                                        <span class="avatar-title bg-primary rounded-circle">P</span>
                                                    </div>
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Godwin Adanez">
                                                        <span class="avatar-title bg-success rounded-circle">G</span>
                                                    </div>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Lisle Essam">
                                                        <img src="assets/media/image/user/women_avatar2.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Baxie Roseblade">
                                                        <img src="assets/media/image/user/man_avatar5.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Mella Mixter">
                                                        <img src="assets/media/image/user/women_avatar1.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Jo Hugill">
                                                        <img src="assets/media/image/user/man_avatar1.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Cullie Philcott">
                                                        <img src="assets/media/image/user/women_avatar5.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item task-list active">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck4" checked="">
                                        <label class="custom-control-label" for="customCheck4"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star-o font-size-16"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">Get The Boot A Birds Eye Look Into Mcse Boot Camps
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-warning">Social</div>
                                            </div>
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="avatar-group">
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Godwin Adanez">
                                                        <span class="avatar-title bg-success rounded-circle">G</span>
                                                    </div>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Lisle Essam">
                                                        <img src="assets/media/image/user/women_avatar2.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item task-list">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck5">
                                        <label class="custom-control-label" for="customCheck5"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star-o font-size-16"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">Buying Used Electronic Test Equipment.
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-success">Freelance</div>
                                            </div>
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="avatar-group">
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Polly Everist">
                                                        <span class="avatar-title bg-primary rounded-circle">P</span>
                                                    </div>
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Godwin Adanez">
                                                        <span class="avatar-title bg-success rounded-circle">G</span>
                                                    </div>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Lisle Essam">
                                                        <img src="assets/media/image/user/women_avatar2.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Baxie Roseblade">
                                                        <img src="assets/media/image/user/man_avatar5.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Mella Mixter">
                                                        <img src="assets/media/image/user/women_avatar1.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item task-list">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck6">
                                        <label class="custom-control-label" for="customCheck6"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star-o font-size-16"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">Fix Responsiveness
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-warning">Theme Support</div>
                                            </div>
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="avatar-group">
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Godwin Adanez">
                                                        <span class="avatar-title bg-warning rounded-circle">G</span>
                                                    </div>
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Polly Everist">
                                                        <span class="avatar-title bg-info rounded-circle">P</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item task-list">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck7">
                                        <label class="custom-control-label" for="customCheck7"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star font-size-16 text-warning"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">
                                            Hypnotherapy For Motivation Getting The Drive Back
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-secondary">Coding</div>
                                            </div>
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="avatar-group">
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Baxie Roseblade">
                                                        <img src="assets/media/image/user/man_avatar5.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item task-list">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck8">
                                        <label class="custom-control-label" for="customCheck8"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star-o font-size-16"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">Are You Struggling In Life
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-warning">Theme Support</div>
                                            </div>
                                            <div class="mr-3">
                                                <div class="avatar-group">
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Polly Everist">
                                                        <span class="avatar-title bg-primary rounded-circle">P</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item task-list">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck9">
                                        <label class="custom-control-label" for="customCheck9"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star-o font-size-16"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">Believing Is The Absence Of Doubt
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-success">Freelance</div>
                                            </div>
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="avatar-group">
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Lisle Essam">
                                                        <img src="assets/media/image/user/women_avatar2.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Baxie Roseblade">
                                                        <img src="assets/media/image/user/man_avatar5.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Mella Mixter">
                                                        <img src="assets/media/image/user/women_avatar1.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item task-list">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck10">
                                        <label class="custom-control-label" for="customCheck10"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star-o font-size-16"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">Success Steps For Your Personal Or Business Life
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-danger">Social</div>
                                            </div>
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="avatar-group">
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Mella Mixter">
                                                        <img src="assets/media/image/user/women_avatar1.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Polly Everist">
                                                        <span class="avatar-title bg-primary rounded-circle">P</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item task-list">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck11">
                                        <label class="custom-control-label" for="customCheck11"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star-o font-size-16"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">Don't Let The Outtakes Take You Out
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-warning">Theme Support</div>
                                            </div>
                                            <div class="mr-3">
                                                <div class="avatar-group">
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Godwin Adanez">
                                                        <span class="avatar-title bg-success rounded-circle">G</span>
                                                    </div>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Lisle Essam">
                                                        <img src="assets/media/image/user/women_avatar2.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item task-list">
                                <div class="mr-3">
                                    <a href="#" class="app-sortable-handle ui-sortable-handle">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move width-15 height-15"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                                    </a>
                                </div>
                                <div>
                                    <div class="custom-control custom-checkbox custom-checkbox-success mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck12">
                                        <label class="custom-control-label" for="customCheck12"></label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="add-star mr-3" title="Add stars">
                                        <i class="fa fa-star-o font-size-16"></i>
                                    </a>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                        <div class="app-list-title text-truncate">It is a good idea to think of your PC as an office.
                                        </div>
                                        <div class="pl-3 d-flex align-items-center">
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="badge badge-warning">Theme Support</div>
                                            </div>
                                            <div class="mr-3 d-sm-inline d-none">
                                                <div class="avatar-group">
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Godwin Adanez">
                                                        <span class="avatar-title bg-success rounded-circle">G</span>
                                                    </div>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Lisle Essam">
                                                        <img src="assets/media/image/user/women_avatar2.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Baxie Roseblade">
                                                        <img src="assets/media/image/user/man_avatar5.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Mella Mixter">
                                                        <img src="assets/media/image/user/women_avatar1.jpg" class="rounded-circle" alt="image">
                                                    </figure>
                                                    <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Polly Everist">
                                                        <span class="avatar-title bg-primary rounded-circle">P</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" title="" data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 width-15 height-15"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- end::app-lists -->

                    <!-- begin:app-detail -->
                    <div class="card app-detail">
                        <div class="card-header">
                            <div class="app-detail-action-left">
                                <a class="app-detail-close-button" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left mr-3"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                </a>
                                <h5 class="mb-0">Draw design and presentation for customers. </h5>
                            </div>
                            <div class="app-detail-action-right">
                                <div>
                                    <a href="#" class="btn btn-success" data-toggle="tooltip" title="" data-original-title="2:44 AM">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mr-2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        Completed
                                    </a>
                                    <span data-toggle="modal" data-target="#editTaskModal">
                                        <a href="#" class="btn btn-outline-light ml-2" title="" data-toggle="tooltip" data-original-title="Edit Task">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                        </a>
                                    </span>
                                    <a href="#" class="btn btn-outline-light ml-2" data-toggle="tooltip" title="" data-original-title="Delete Task">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="app-detail-article">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-l-r-0 m-b-20">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Polly Everist">
                                                <span class="avatar-title bg-primary rounded-circle">P</span>
                                            </div>
                                            <div class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Godwin Adanez">
                                                <span class="avatar-title bg-success rounded-circle">G</span>
                                            </div>
                                            <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Lisle Essam">
                                                <img src="assets/media/image/user/women_avatar2.jpg" class="rounded-circle" alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Baxie Roseblade">
                                                <img src="assets/media/image/user/man_avatar5.jpg" class="rounded-circle" alt="image">
                                            </figure>
                                            <figure class="avatar avatar-sm" title="" data-toggle="tooltip" data-original-title="Mella Mixter">
                                                <img src="assets/media/image/user/women_avatar1.jpg" class="rounded-circle" alt="image">
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="badge bg-warning badge-pill mr-2">Theme Support</span>
                                        <a href="#" data-toggle="tooltip" title="" class="mr-2" data-original-title="Files">
                                            <i class="fa fa-paperclip"></i>
                                        </a>
                                        <a href="#" class="mr-2">
                                            <i class="fa fa-star font-size-16 text-warning"></i>
                                        </a>
                                        <span class="text-muted">4:14 AM</span>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur corporis
                                    incidunt labore modi numquam omnis pariatur possimus suscipit vitae voluptas?</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aperiam asperiores
                                    error esse fugiat fugit laboriosam necessitatibus officia, placeat, quam quis
                                    reprehenderit similique soluta suscipit tempore! Consequuntur eligendi hic in libero
                                    nostrum rem ut? At itaque laboriosam natus provident reprehenderit.</p>
                            </div>
                            <hr class="m-0">
                            <div class="card-body">
                                <h6 class="mb-3 font-size-11 text-uppercase">Files</h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="small">
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip mr-1 width-15 height-15"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                                            uikit-design.psd
                                        </a>
                                    </li>
                                    <li class="small">
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip mr-1 width-15 height-15"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                                            uikit-design.sketch
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <hr class="m-0">
                            <div class="card-body">
                                <h6 class="mb-3 font-size-11 text-uppercase">Comment</h6>
                                <div class="reply-email-quill-editor mb-3 ql-container ql-snow"><div class="ql-editor ql-blank" data-gramm="false" contenteditable="true" data-placeholder="Type something... "><p><br></p></div><div class="ql-clipboard" contenteditable="true" tabindex="-1"></div><div class="ql-tooltip ql-hidden"><a class="ql-preview" target="_blank" href="about:blank"></a><input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL"><a class="ql-action"></a><a class="ql-remove"></a></div></div>
                                <div class="d-flex justify-content-between">
                                    <div class="reply-email-quill-toolbar ql-toolbar ql-snow">
                                        <span class="ql-formats mr-0">
                                          <button class="ql-bold" type="button"><svg viewBox="0 0 18 18"> <path class="ql-stroke" d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"></path> <path class="ql-stroke" d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"></path> </svg></button>
                                          <button class="ql-italic" type="button"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="7" x2="13" y1="4" y2="4"></line> <line class="ql-stroke" x1="5" x2="11" y1="14" y2="14"></line> <line class="ql-stroke" x1="8" x2="10" y1="14" y2="4"></line> </svg></button>
                                          <button class="ql-underline" type="button"><svg viewBox="0 0 18 18"> <path class="ql-stroke" d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"></path> <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="12" x="3" y="15"></rect> </svg></button>
                                          <button class="ql-link" type="button"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="7" x2="11" y1="7" y2="11"></line> <path class="ql-even ql-stroke" d="M8.9,4.577a3.476,3.476,0,0,1,.36,4.679A3.476,3.476,0,0,1,4.577,8.9C3.185,7.5,2.035,6.4,4.217,4.217S7.5,3.185,8.9,4.577Z"></path> <path class="ql-even ql-stroke" d="M13.423,9.1a3.476,3.476,0,0,0-4.679-.36,3.476,3.476,0,0,0,.36,4.679c1.392,1.392,2.5,2.542,4.679.36S14.815,10.5,13.423,9.1Z"></path> </svg></button>
                                          <button class="ql-image" type="button"><svg viewBox="0 0 18 18"> <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect> <circle class="ql-fill" cx="6" cy="7" r="1"></circle> <polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline> </svg></button>
                                        </span>
                                    </div>
                                    <button class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send mr-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                        Send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection