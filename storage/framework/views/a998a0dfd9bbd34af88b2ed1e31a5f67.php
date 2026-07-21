
                    <style>
                        /* Apple-esque Glassmorphism for Filament */
                        :root {
                            --fi-border-radius: 1.5rem !important; /* rounded-3xl */
                        }
                        
                        /* Clean Backgrounds */
                        .fi-body {
                            background-color: #f8fafc !important; /* slate-50 */
                        }
                        .dark .fi-body {
                            background-color: #0f172a !important; /* slate-900 */
                        }
                        
                        /* Glassy Cards */
                        .fi-ta-ctn, .fi-wi, .fi-fo-fieldset, .fi-section {
                            background: rgba(255, 255, 255, 0.7) !important;
                            backdrop-filter: blur(16px) !important;
                            -webkit-backdrop-filter: blur(16px) !important;
                            border: 1px solid rgba(255, 255, 255, 0.4) !important;
                            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.05), 0 4px 6px -4px rgb(0 0 0 / 0.05) !important;
                        }
                        
                        .dark .fi-ta-ctn, .dark .fi-wi, .dark .fi-fo-fieldset, .dark .fi-section {
                            background: rgba(30, 41, 59, 0.7) !important;
                            border: 1px solid rgba(255, 255, 255, 0.05) !important;
                            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.3) !important;
                        }

                        /* Softer Input Borders */
                        .fi-input-wrp {
                            border-radius: 1rem !important;
                        }
                        
                        /* Floating Sidebar Active States */
                        .fi-sidebar-item-active > a {
                            background: linear-gradient(135deg, rgba(236, 72, 153, 0.1), rgba(225, 29, 72, 0.05)) !important;
                            border-radius: 1rem !important;
                        }
                        
                        .dark .fi-sidebar-item-active > a {
                            background: linear-gradient(135deg, rgba(236, 72, 153, 0.15), rgba(225, 29, 72, 0.1)) !important;
                        }
                    </style>
                <?php /**PATH /var/www/aquaboom/storage/framework/views/f9e29aebd411fbc69aebe87472b61b3f.blade.php ENDPATH**/ ?>