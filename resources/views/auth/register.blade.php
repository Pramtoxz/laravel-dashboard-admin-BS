<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    
   <script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    primary: '#3b71ca',
                    secondary: '#9fa6b2',
                    info: '#54b4d3',
                }
            },
            fontFamily: {
                body: ['Plus Jakarta Sans', 'sans-serif'],
                sans: ['Plus Jakarta Sans', 'sans-serif'],
            },
        }
    }
</script>
</head>
<body class="font-body">
    <section class="h-screen">
  <div class="container h-full px-6 py-24">
    <div
      class="flex h-full flex-wrap items-center justify-center lg:justify-between">
      <div class="mb-12 md:mb-0 md:w-8/12 lg:w-6/12">
        <img
          src="https://tecdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="w-full"
          alt="Phone image" />
      </div>

      <div class="md:w-8/12 lg:ms-6 lg:w-5/12">
        <form action="{{route('register.proses')}}" method="POST">
            @csrf
            <div class="relative mb-6" data-twe-input-wrapper-init>
            <input
              type="text"
              name="name"
              class="peer block w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-twe-input-state-active:placeholder:opacity-100 motion-reduce:transition-none dark:text-white dark:placeholder:text-neutral-300 dark:autofill:shadow-autofill dark:peer-focus:text-primary [&:not([data-twe-input-placeholder-active])]:placeholder:opacity-0"
              placeholder="Masukan Username" />
            <label
              for="exampleFormControlInput3"
              class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-top-left truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-twe-input-state-active:-translate-y-[1.15rem] peer-data-twe-input-state-active:scale-[0.8] motion-reduce:transition-none dark:text-neutral-400 dark:peer-focus:text-primary"
              >Username
            </label>
          </div>
          <div class="relative mb-6" data-twe-input-wrapper-init>
            <input
              type="text"
              name="email"
              class="peer block w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-twe-input-state-active:placeholder:opacity-100 motion-reduce:transition-none dark:text-white dark:placeholder:text-neutral-300 dark:autofill:shadow-autofill dark:peer-focus:text-primary [&:not([data-twe-input-placeholder-active])]:placeholder:opacity-0"
              id="exampleFormControlInput3"
              placeholder="Email address" />
            <label
              for="exampleFormControlInput3"
              class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-top-left truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-twe-input-state-active:-translate-y-[1.15rem] peer-data-twe-input-state-active:scale-[0.8] motion-reduce:transition-none dark:text-neutral-400 dark:peer-focus:text-primary"
              >Email address
            </label>
          </div>
          <div class="relative mb-6" data-twe-input-wrapper-init>
            <input
              type="password"
              name="password"
              class="peer block w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-twe-input-state-active:placeholder:opacity-100 motion-reduce:transition-none dark:text-white dark:placeholder:text-neutral-300 dark:autofill:shadow-autofill dark:peer-focus:text-primary [&:not([data-twe-input-placeholder-active])]:placeholder:opacity-0"
              id="exampleFormControlInput33"
              placeholder="Password" />
            <label
              for="exampleFormControlInput33"
              class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-top-left truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-twe-input-state-active:-translate-y-[1.15rem] peer-data-twe-input-state-active:scale-[0.8] motion-reduce:transition-none dark:text-neutral-400 dark:peer-focus:text-primary"
              >Password
            </label>
          </div>
          <div class="relative mb-6" data-twe-input-wrapper-init>
            <input
              type="password"
              name="password_confirm"
              class="peer block w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-twe-input-state-active:placeholder:opacity-100 motion-reduce:transition-none dark:text-white dark:placeholder:text-neutral-300 dark:autofill:shadow-autofill dark:peer-focus:text-primary [&:not([data-twe-input-placeholder-active])]:placeholder:opacity-0"
              id="exampleFormControlInput33"
              placeholder="Ulangi Password" />
            <label
              for="exampleFormControlInput33"
              class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-top-left truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-twe-input-state-active:-translate-y-[1.15rem] peer-data-twe-input-state-active:scale-[0.8] motion-reduce:transition-none dark:text-neutral-400 dark:peer-focus:text-primary"
              >Ulangi
            </label>
          </div>
          <button
            type="submit"
            class="inline-block w-full rounded bg-primary px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
            data-twe-ripple-init
            data-twe-ripple-color="light">
            Sign in
          </button>
          <div
            class="my-4 flex items-center before:mt-0.5 before:flex-1 before:border-t before:border-neutral-300 after:mt-0.5 after:flex-1 after:border-t after:border-neutral-300 dark:before:border-neutral-500 dark:after:border-neutral-500">
            <p
              class="mx-4 mb-0 text-center font-semibold dark:text-neutral-200">
              OR
            </p>
          </div>
          <a
            class="mb-3 flex w-full items-center justify-center rounded bg-primary px-7 pb-2.5 pt-3 text-center text-sm font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
            style="background-color: #3b5998"
            href="/login"
            role="button"
            data-twe-ripple-init
            data-twe-ripple-color="light">
            <span
              class="me-2 fill-white [&>svg]:mx-auto [&>svg]:h-3.5 [&>svg]:w-3.5">
            </span>
            Sudah Punya Akun? Silahkan Masuk!
          </a>
        </form>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    @endif
    @if(session('failed'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('failed') }}',
        });
    @endif
    @if($errors->any())
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian',
            html: `
                <ul style="text-align: left;">
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            `,
        });
    @endif
</script>
</body>
</html>