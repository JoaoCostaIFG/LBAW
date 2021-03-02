<?php
$title = "Search Results";
require_once '../templates/tpl_header.php';
?>

<div class="container">
    <!-- Sidebar -->
    <div class="row">
        <nav class="col-md-2 d-md-block bg-light collapse border-end border-dark">
            <div class="sticky-top d-flex flex-column align-items-start gap-3" style="top: 4rem;">
                <a class=" text-decoration-none mt-3" href="#">
                    <i class="bi bi-house-door"></i>
                    Home
                </a>
                <a class=" text-decoration-none" href="#">
                    <i class="bi bi-tag"></i>
                    Topics</a>
                <a class="text-decoration-none" href="#">
                    <i class="bi bi-person"></i>
                    Users</a>
            </div>
        </nav>

        <div class="col-xl-8 col">
            <!-- Header -->
            <header class="py-3 px-4 border-bottom">
                <h2> Search Results </h2>
                <div class="d-flex flex-row justify-content-between">
                    <!-- Number of Results -->
                    <h6>50 results</h6>
                    <i class="bi bi-filter-right"></i>
                </div>
            </header>

            <!-- Question Accordion -->
            <div class="accordion ">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <!-- Question Button -->
                        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="d-flex flex-sm-row flex-row-reverse justify-content-start align-items-center gap-3 w-100">
                                <div class="d-flex flex-row flex-sm-column justify-content-start align-items-center gap-3 align-self-end">
                                    <!-- Number Votes -->
                                    <div class="d-flex flex-row flex-sm-column justify-content-center align-items-center gap-1">
                                        <span class="fs-4">10</span>
                                        <span class="d-none d-md-block">Votes</span>
                                        <span class="d-md-none"><i class="bi bi-arrow-down-up"></i></span>
                                    </div>
                                    <!-- Number Answers -->
                                    <div class="d-flex flex-row flex-sm-column justify-content-center align-items-center gap-1">
                                        <span class="fs-4">7</span>
                                        <span class="d-none d-md-block">Answers</span>
                                        <span class="d-md-none"><i class="bi bi-chat-left-text"></i></span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-start align-items-start w-100">
                                    <!-- Question Text -->
                                    <div>
                                        <p class="fs-5 fw-bold">How do I undo the most recent local commits in Git?
                                        </p>
                                        <p class="d-none d-md-block">I accidentally committed the wrong files to
                                            Git,
                                            but didn't
                                            push the commit to
                                            the server yet. How can I undo those commits from the local repository?
                                            …
                                        </p>
                                    </div>
                                    <div class="w-100 gap-1 d-flex flex-row align-items-center justify-content-between align-self-start">
                                        <!-- Question Tags -->
                                        <div class="d-none d-sm-block d-grid gap-1">
                                            <a class="badge bg-primary text-decoration-none">git</a>
                                            <a class="badge bg-primary text-decoration-none">git-commit</a>
                                            <a class="badge bg-primary text-decoration-none">version-control</a>
                                        </div>
                                        <!-- Question Date -->
                                        <div class="d-flex flex-row gap-2 align-items-center">
                                            <span class="align-self-end">asked 1 hour ago</span>

                                            <!-- Author User Info -->
                                            <!-- User Profile Pic  -->
                                            <img class="d-none d-sm-block rounded-2 fit-cover" src="../static/images/user.png" alt="User Picture" width="40px" height="40px">

                                            <div class="d-flex flex-row flex-sm-column justify-content-center align-items-start">
                                                <!-- Username -->
                                                <span class="d-sm-none">by&nbsp;</span>
                                                <span>Ananachos</span>
                                                <!-- User Points -->
                                                <span class="d-none d-sm-block">387 <i class="bi bi-award"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <!-- Question Content -->
                        <div class="accordion-body">
                            Question description
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <nav class="col-md-2 bg-light border-start border-dark"></nav>
    </div>
</div>

<?php
require_once '../templates/tpl_footer.php';
?>