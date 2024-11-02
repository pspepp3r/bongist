
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0" />
		<meta
			http-equiv="X-UA-Compatible"
			content="ie=edge" />

		

		<title>Dashboard</title>

		<meta
			name="author"
			content="name" />
		<meta
			name="description"
			content="description here" />
		<meta
			name="keywords"
			content="keywords,here" />

		<link
			rel="stylesheet"
			href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
		<link
			rel="stylesheet"
			href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
		<!--Replace with your tailwind.css once created-->
		<link
			href="https://afeld.github.io/emoji-css/emoji.css"
			rel="stylesheet" />
		<!--Totally optional :) -->
		<script
			src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"
			integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis="
			crossorigin="anonymous"></script>
	</head>

	<body class=" font-sans leading-normal tracking-normal mt-12">
		<header>
			<!--Nav-->
			<nav
				aria-label="menu nav"
				class="bg-white pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">
				<div class="flex items-center">
					<div class="flex justify-center items-center">
						<img
							class="w-24 h-10"
							src="https://bongistkoncepts.com/assets/images/logo.png"
							alt="mich" />

					
					</div>

					<div
						class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
						<!--  -->
					</div>

					<div
						class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
						<ul
							class="list-reset flex justify-between flex-1 md:flex-none items-center">
                            <li class="flex-1 md:flex-none md:mr-3">
								<a
									class="inline-block py-2 px-3 mr-1 text-white no-underline text-xs bg-blue-900 rounded-md"
									href="/bongist/admin"
									>Back </a
								>
							</li>

							<li class="flex md:flex-none md:mr-3">
								<a
									class="inline-block py-2 px-3 mr-1 text-white no-underline text-xs bg-blue-900 rounded-md"
									href="add_invoice"
									>Create Invoice</a
								>
							</li>
						
							<li class="flex-1 md:flex-none md:mr-3">
								
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

		<main>
			<div class="flex flex-col md:flex-row">
				<nav aria-label="alternative nav " class="mb-0">
					<div
						class="bg-white shadow-xl  fixed bottom-0  md:relative md:h-screen z-10 w-full md:w-48 content-center">
						<div
							class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
							<ul
								class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
								
								<li class="mr-3 flex-1">
									<a
										href="add_invoice"
										class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-blue-900 no-underline hover:text-white text-xs  border-gray-800 font-semibold">
										<i class="fas fa-file-invoice"></i>
										<span 
										class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block"
											>Invoice</span
										>
									</a>
								</li>
							
								<li class="mr-3 flex-1">
									<a
										href="all_invoice"
										class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-blue-900 no-underline hover:text-white border-gray-800 font-semibold">
										<i class="fas fa-file-invoice-dollar"></i>
										<span
											class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block"
											>All Invoice</span
										>
									</a>
								</li>

								<li class="mr-3 flex-1">
									<a
										href="all_receipt"
										class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-blue-900 no-underline hover:text-white  border-gray-800 font-semibold">
										<i class="fas fa-receipt"></i>
										<span
											class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block"
											>Receipts </span
										>
									</a>
								</li>

                                <li class="mr-3 flex-1">
									<a
										href="/#"
										class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-blue-900 no-underline hover:text-white border-gray-800 font-semibold ">
										<i class="fas fa-chart-line"> </i>
										<span
											class="pb-1 md:pb-0 text-xs md:text-base  block md:inline-block"
											>Summary</span
										>
									</a>
								</li>
								<li class="mr-3 flex-1">
									<a
										href="account_dashboard"
										class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-blue-900 no-underline hover:text-white border-gray-800 font-semibold">
										<i class="fas fa-user-circle"></i>
										<span
											class="pb-1 md:pb-0 text-xs md:text-base  block md:inline-block"
											>Dashboard</span
										>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			