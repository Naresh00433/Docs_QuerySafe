                    <form class="d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center w-100 mb-3 me-lg-4 mb-lg-0 position-relative" role="search" method="get" action="/Documentation_QuerySafe/search.php">
                        <div class="position-relative w-100">
                            <input
                                class="form-control rounded-pill ps-5 pe-4 py-2 shadow-sm border-1 w-100"
                                type="search"
                                name="q"
                                placeholder="Search documentation..."
                                aria-label="Search"
                                style="background-color: #f5f5fa; font-size: 1rem;"
                                value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" />
                            <button
                                class="btn btn-primary position-absolute end-0 top-50 translate-middle-y me-2 rounded-pill px-3 py-1"
                                type="submit"
                                style="background: linear-gradient(90deg, #8f4be9 0%, #6c2eb7 100%); border: none; font-weight: 500;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242 1.106a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                                </svg>
                            </button>
                            <span class="position-absolute start-0 top-50 translate-middle-y ms-3 text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#8f4be9" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242 1.106a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                                </svg>
                            </span>
                        </div>
                    </form>
                    </div>
                    <style>
                        @media (max-width: 991.98px) {
                            .navbar-collapse .form-control[type="search"] {
                                min-width: 0;
                                width: 90vw !important;
                                max-width: 100vw;
                                margin-right: 0;
                                margin-top: 0.5rem;
                            }

                            .navbar-collapse form.d-flex {
                                width: 100% !important;
                                justify-content: center;
                                margin-bottom: 1rem;
                            }

                            .navbar-collapse .btn[type="submit"] {
                                right: 0.5rem;
                            }
                        }

                        @media (max-width: 450px) {
                            .navbar-collapse .form-control[type="search"] {
                                width: 90vw !important;
                                font-size: 0.95rem;
                            }

                            .navbar-collapse form.d-flex {
                                width: 100vw !important;
                                padding-left: 0.5rem;
                                padding-right: 0.5rem;
                            }
                        }
                    </style>
                    <div class="d-lg-none w-100 px-2">
                        <?php
                        // Use the same $sidebar and renderSidebar as in page.php
                        if (!isset($sidebar)) {
                            $sidebarJson = __DIR__ . '/../docs/sidebar.json';
                            $sidebar = json_decode(file_get_contents($sidebarJson), true);
                        }
                        if (!function_exists('renderSidebar')) {
                            // Paste the renderSidebar function here or require it from a shared file
                        }
                        renderSidebar($sidebar);
                        ?>
                    </div>