<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>RapiExpress - Dashboard</title>
        <link rel="icon" href="assets\img\logo-rapi.ico" type="image/x-icon">

		 

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href=" vendor\twbs\bootstrap\css/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="vendor\twbs\bootstrap\css/icon-font.min.css"
            
		/>

        <link
			rel="stylesheet"
			type="text/css"
			href="assets/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="assets/css/responsive.bootstrap4.min.css"
		/>
		
		<link rel="stylesheet" type="text/css" href="vendor\twbs\bootstrap\css/style.css" />

		
		 
	</head>
	<body>
		 

		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
				<div
					class="search-toggle-icon bi bi-search"
					data-toggle="header_search"
				></div>
				<div class="header-search">
					<form>
						<div class="form-group mb-0">
							<i class="dw dw-search2 search-icon"></i>
							<input
								type="text"
								class="form-control search-input"
								placeholder="Search Here"
							/>
							<div class="dropdown">
								<a
									class="dropdown-toggle no-arrow"
									href="#"
									role="button"
									data-toggle="dropdown"
								>
									<i class="ion-arrow-down-c"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label"
											>From</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">To</label>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label"
											>Subject</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="text-right">
										<button class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="header-right">
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						>
							<i class="dw dw-settings2"></i>
						</a>
					</div>
				</div>
				 
				<div class="user-info-dropdown">
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            <span class="user-icon">
                <img src="assets/img/photo1.jpg" alt="Foto de perfil" />
            </span>
            <span class="user-name">
                <?= isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : 'Invitado' ?>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
            <?php if(isset($_SESSION['usuario'])): ?>
                
                
                <a class="dropdown-item" href="index.php?c=auth&a=logout">
                    <i class="dw dw-logout"></i> Cerrar Sesión
                </a>
            
            <?php endif; ?>
        </div>
    </div>
</div>
				
			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					configuración de diseño
					<span class="btn-block font-weight-400 font-12"
						>Configuración de la interfaz de usuario</span>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Fondo del encabezado</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-white active"
							>Claro</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Oscuro</a
						>
					</div>
					<h4 class="weight-600 font-18 pb-10">Fondo de la barra lateral</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>Claro</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Oscuro</a
						>
					</div>

					 
					<div class="reset-options pt-30 text-center">
						<button class="btn btn-danger" id="reset-settings">
							Restablecer configuración
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="index.php?c=dashboard&a=index">
					<img src=" assets\img/logo-rapiC.png" alt="" class="dark-logo" />
					<img
						src=" assets\img/logo-rapiD.png"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li>
                    <a href="index.php?c=dashboard&a=index" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-speedometer2"></span>
                        <span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?c=tienda&a=index" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-shop"></span>
                        <span class="mtext">Tiendas</span>
                    </a>
                		</li>			
					</ul>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="xs-pd-20-10 pd-ltr-20">
				<div class="title pb-20">
					<h2 class="h3 mb-0">Dashboard</h2>
				</div>

				<div class="row pb-10">
					
					
				</div>

								
					
<div class="title pb-20">
					<h2 class="h3 mb-0"> Registro de Empleados</h2>
				</div>
				

    <div class="card-box mb-30">
        
        <div class="pd-20">
            <h4 class="text-blue h4">Lista de Empleados</h4>
            
            
        </div>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap" id="empleadosTable">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Nombre y Apellido</th>
                        <th>Sucursal</th>
                        <th>Correo</th>
                        <th>Fecha Registro</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empleados as $empleado): ?>
                    <tr>
                        <td><?= htmlspecialchars($empleado['documento']) ?></td>
                        <td class="table-plus"><?= htmlspecialchars($empleado['nombres'] . ' ' . $empleado['apellidos']) ?></td>
                        <td><?= htmlspecialchars($empleado['sucursal']) ?></td>
                        <td><?= htmlspecialchars($empleado['email']) ?></td>
                        <td><?= date('d/m/Y', strtotime($empleado['fecha_registro'])) ?></td>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    





				
				<div class="footer-wrap pd-20 mb-20 card-box">
					RapiExpress © 2025 - Sistema de Gestión de Paquetes				
				</div>
			</div>
		</div>
	 

        <script src="vendor\twbs\bootstrap\js/core.js"></script>
		<script src="vendor\twbs\bootstrap\js/script.min.js"></script>
		<script src="vendor\twbs\bootstrap\js/process.js"></script>
		<script src="vendor\twbs\bootstrap\js/layout-settings.js"></script>
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/dataTables.bootstrap4.min.js"></script>
		<script src="assets/js/dataTables.responsive.min.js"></script>
		<script src="assets/js/responsive.bootstrap4.min.js"></script>
		
		<script src="assets/js/dataTables.buttons.min.js"></script>
		<script src="assets/js/buttons.bootstrap4.min.js"></script>
		<script src="assets/js/buttons.print.min.js"></script>
		<script src="assets/js/buttons.html5.min.js"></script>
		<script src="assets/js/buttons.flash.min.js"></script>
		<script src="assets/js/pdfmake.min.js"></script>
		<script src="assets/js/vfs_fonts.js"></script>
		
		<script src="vendor\twbs\bootstrap\js/datatable-setting.js"></script>

		 
	</body>
</html>
