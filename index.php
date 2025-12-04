<?php
include "config.php";
include "traitement.php";
?>

<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Dashboard — Modernized</title>

  <!-- Tailwind CDN with forms plugin -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

  <!-- Tailwind config: desktop-first theme extension -->
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: { display: ['Manrope', 'sans-serif'] },
          colors: {
            // light primary (used in light mode)
            primary: '#2563eb',
            // neutral / cards - we will use Tailwind defaults for rest
          },
          borderRadius: { 'md-xl': '0.75rem', '2xl': '1rem' },
          boxShadow: {
            subtle: '0 6px 18px -8px rgba(16,24,40,0.32), 0 2px 6px rgba(2,6,23,0.06)',
            light: '0 4px 10px rgba(2,6,23,0.04)'
          }
        }
      }
    }
  </script>

  <style>
    /* small helper for the material icons weight */
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    /* For the dark-mode custom accent: use mauve/pink gradient on CTAs in dark mode */
    :root { --card-bg: #ffffff; --bg: #f6f8f7; --muted: #6b7280; --accent-light: #2563eb; }
    .dark { --card-bg: #0f1720; --bg: #0b1210; --muted: #9db8a8; --accent-dark-from: #7c3aed; --accent-dark-to: #ec4899; }
    /* small accessibility focus outline */
    :focus { outline: 2px solid transparent; outline-offset: 2px; }
    .focus-ring:focus { box-shadow: 0 0 0 4px rgba(37,99,235,0.12); border-color: rgba(37,99,235,0.6); }
    /* preserve min-height like your original */
    body { min-height: max(884px, 100dvh); }
  </style>
</head>
<body class="font-display text-gray-800 bg-[color:var(--bg)] dark:bg-[color:var(--bg)]">

  <!-- Small app.js (external could be used). This script handles dark toggle and modal sample. -->
  <script>

    document.addEventListener("click", function (e) {
    const action = e.target.getAttribute("data-action");
    const target = e.target.getAttribute("data-target");

    if (action === "open-modal") {
      document.getElementById(target).classList.remove("hidden");
    }

    if (action === "close-modal") {
      document.getElementById(target).classList.add("hidden");
    }
  });
    // Immediately-invoked to avoid global pollution
    (function () {
      // Persisted theme in localStorage
      const root = document.documentElement;
      const themeKey = 'ui-theme';
      function applyTheme(theme) {
        if (theme === 'dark') root.classList.add('dark'), root.classList.remove('light');
        else root.classList.remove('dark'), root.classList.add('light');
      }
      // init
      const saved = localStorage.getItem(themeKey) || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
      applyTheme(saved);

      // expose toggle for button
      window.uiTheme = {
        toggle: function() {
          const isDark = document.documentElement.classList.contains('dark');
          const next = isDark ? 'light' : 'dark';
          applyTheme(next);
          localStorage.setItem(themeKey, next);
        }
      };
window.modal = {
  open(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove("hidden");
  },
  close(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.add("hidden");
  }
};

document.addEventListener("click", function(e) {
  const el = e.target.closest("[data-action]");
  if (!el) return;

  const action = el.dataset.action;
  const target = el.dataset.target;
  if (!action || !target) return;

  if (action === "open") window.modal.open(target);
  if (action === "close") window.modal.close(target);
});



    })();
  </script>

  <div class="min-h-screen flex flex-col">

    <header class="sticky top-0 z-30 backdrop-blur-sm bg-white/60 dark:bg-black/40 border-b border-gray-200 dark:border-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
        <div></div>
          <div class="flex items-center ">
              <span class="font-bold text-3xl text-[color:var(--accent-light)] dark:text-transparent bg-clip-text dark:bg-gradient-to-r dark:from-[color:var(--accent-dark-from)] dark:to-[color:var(--accent-dark-to)]">
                Your Smart Wallet</span>
          </div>

          <div class="flex items-center gap-3">
            <button data-action="toggle-theme" aria-label="Toggle theme" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/6 focus-ring">
              <span class="material-symbols-outlined ">light_mode</span>
            </button> 
        
          </div>
        </div>
      </div>
    </header>

    <!-- Main content -->
    <main class="flex-1">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <!-- Stats cards -->
        <!-- Comment (FR): Section des cartes de stat — Total Revenues, Expenses, Balance -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
          <div class="rounded-2xl bg-[color:var(--card-bg)] p-6 border border-gray-100 dark:border-gray-800 shadow-subtle transition hover:shadow-lg">
            <div class="flex items-start justify-between gap-4">
              <div>
                <p class="text-sm text-gray-500 dark:text-[color:var(--muted)]">Total Revenues</p>
                <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">$5,400.00</p>
              </div>
              <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-blue-50 dark:bg-gradient-to-br dark:from-[color:var(--accent-dark-from)] dark:to-[color:var(--accent-dark-to)]">
                <span class="material-symbols-outlined text-blue-600 dark:text-white">payments</span>
              </div>
            </div>
          </div>

          <div class="rounded-2xl bg-[color:var(--card-bg)] p-6 border border-gray-100 dark:border-gray-800 shadow-subtle transition hover:shadow-lg">
            <div class="flex items-start justify-between gap-4">
              <div>
                <p class="text-sm text-gray-500 dark:text-[color:var(--muted)]">Total Expenses</p>
                <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">$2,150.50</p>
              </div>
              <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-red-50 dark:bg-red-900/30">
                <span class="material-symbols-outlined text-red-600 dark:text-red-300">arrow_downward</span>
              </div>
            </div>
          </div>

          <div class="rounded-2xl bg-[color:var(--card-bg)] p-6 border border-gray-100 dark:border-gray-800 shadow-subtle transition hover:shadow-lg">
            <div class="flex items-start justify-between gap-4">
              <div>
                <p class="text-sm text-gray-500 dark:text-[color:var(--muted)]">Current Balance</p>
                <p class="mt-2 text-2xl font-bold text-[color:var(--accent-light)] dark:text-transparent bg-clip-text dark:bg-gradient-to-r dark:from-[color:var(--accent-dark-from)] dark:to-[color:var(--accent-dark-to)]">$3,249.50</p>
              </div>
              <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-green-50 dark:bg-green-900/30">
                <span class="material-symbols-outlined text-green-600 dark:text-green-300">savings</span>
              </div>
            </div>
          </div>
        </section>

        <!-- Chart & quick actions -->
        <section class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
          <!-- Chart area -->
          <div class="xl:col-span-2 rounded-2xl p-6 bg-[color:var(--card-bg)] border border-gray-100 dark:border-gray-800 shadow-subtle">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Monthly Overview</h2>
              <div class="flex gap-2">
                <button class="px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-white/6 text-sm text-gray-700 dark:text-[color:var(--muted)] focus-ring">This Month</button>
                <button class="px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-white/6 text-sm text-gray-700 dark:text-[color:var(--muted)] focus-ring">All Categories</button>
              </div>
            </div>
            <!-- Placeholder mini chart (bars) -->
            <div class="w-full h-56 flex items-end gap-3">
              <!-- simple bars (static) -->
              <div class="flex-1 flex flex-col items-center">
                <div class="w-full rounded-t-xl bg-[color:var(--accent-light)]/30 dark:bg-gradient-to-b dark:from-[color:var(--accent-dark-from)] dark:to-[color:var(--accent-dark-to)]" style="height:48%"></div>
                <span class="mt-2 text-xs text-gray-500 dark:text-[color:var(--muted)]">Week 1</span>
              </div>
              <div class="flex-1 flex flex-col items-center">
                <div class="w-full rounded-t-xl bg-[color:var(--accent-light)]/30 dark:bg-gradient-to-b dark:from-[color:var(--accent-dark-from)] dark:to-[color:var(--accent-dark-to)]" style="height:68%"></div>
                <span class="mt-2 text-xs text-gray-500 dark:text-[color:var(--muted)]">Week 2</span>
              </div>
              <div class="flex-1 flex flex-col items-center">
                <div class="w-full rounded-t-xl bg-[color:var(--accent-light)]/75 dark:bg-gradient-to-b dark:from-[color:var(--accent-dark-from)] dark:to-[color:var(--accent-dark-to)]" style="height:95%"></div>
                <span class="mt-2 text-xs text-gray-500 dark:text-[color:var(--muted)]">Week 3</span>
              </div>
              <div class="flex-1 flex flex-col items-center">
                <div class="w-full rounded-t-xl bg-[color:var(--accent-light)]/20 dark:bg-gradient-to-b dark:from-[color:var(--accent-dark-from)] dark:to-[color:var(--accent-dark-to)]" style="height:30%"></div>
                <span class="mt-2 text-xs text-gray-500 dark:text-[color:var(--muted)]">Week 4</span>
              </div>
            </div>
          </div>

          <!-- Quick actions -->
          <aside class="rounded-2xl p-6 bg-[color:var(--card-bg)] border border-gray-100 dark:border-gray-800 shadow-subtle flex flex-col gap-4">
            <h3 class="text-xl mt-6 text-center font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
            <div class="flex flex-col justify-center gap-6 mt-8">
                 <button data-action="open" data-target="modal-income" name="add_income" class="w-full h-12 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl text-white bg-[color:var(--accent-light)] hover:opacity-95 transition" style="background: linear-gradient(90deg,var(--accent-light),#4f46e5);">
              <span class="material-symbols-outlined">add</span> New Income
            </button>
            <button data-action="open" data-target="modal-expense" class="w-full h-12 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-[color:var(--muted)] hover:bg-gray-50 transition">
              <span class="material-symbols-outlined">remove</span> New Expense
            </button>
            </div>
          </aside>
        </section>

        <!-- Recent transactions list (kept structure, modernized table) -->
        <section class="rounded-2xl p-6 bg-[color:var(--card-bg)] border border-gray-100 dark:border-gray-800 shadow-subtle mb-8">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Transactions</h3>
            <a class="text-sm text-[color:var(--accent-light)] hover:underline" href="#">View All</a>
          </div>

          <!-- Filters row -->
          <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center mb-4">
            <div class="flex gap-2 w-full sm:w-auto">
              <input aria-label="Search transactions" type="search" placeholder="Search" class="px-3 py-2 rounded-xl border border-gray-200 bg-white dark:bg-transparent w-full focus-ring" />
              <select aria-label="Category" class="px-3 py-2 rounded-xl border border-gray-200 bg-white dark:bg-transparent focus-ring">
                <option>All categories</option>
                <option>Income</option>
                <option>Expense</option>
              </select>
            </div>
            <div class="ml-auto flex gap-2">
              <input type="date" aria-label="Start date" class="px-3 py-2 rounded-xl border border-gray-200 bg-white dark:bg-transparent focus-ring" />
              <input type="date" aria-label="End date" class="px-3 py-2 rounded-xl border border-gray-200 bg-white dark:bg-transparent focus-ring" />
            </div>
          </div>

          <!-- Transactions table (kept sample rows) -->
          <div class="overflow-x-auto">
            <table class="w-full text-left">
              <thead class="sticky top-0 bg-white dark:bg-[color:var(--card-bg)]/90">
                <tr>
                  <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-[color:var(--muted)]">Description</th>
                  <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-[color:var(--muted)]">Category</th>
                  <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-[color:var(--muted)] text-right">Amount</th>
                  <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-[color:var(--muted)]">Date</th>
                </tr>
              </thead>
              <tbody id="transactions-table-body">
                <tr class="border-t border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                  <td class="px-4 py-4">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 rounded-lg bg-[color:var(--accent-light)]/10 dark:bg-[color:var(--accent-dark-from)]/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[color:var(--accent-light)] dark:text-white text-sm">shopping_cart</span>
                      </div>
                      <div>
                        <p class="font-semibold text-gray-900 dark:text-white">Starbucks Coffee</p>
                        <p class="text-xs text-gray-500 dark:text-[color:var(--muted)]">Food & Drink ・ Today</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-4 text-sm text-gray-600 dark:text-[color:var(--muted)]">Food & Drink</td>
                  <td class="px-4 py-4 text-right font-semibold text-red-500">-$5.75</td>
                  <td class="px-4 py-4 text-sm text-gray-500 dark:text-[color:var(--muted)]">Dec 3, 2025</td>
                </tr>

                <tr class="border-t border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                  <td class="px-4 py-4">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 rounded-lg bg-green-50 dark:bg-green-900/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-300 text-sm">payments</span>
                      </div>
                      <div>
                        <p class="font-semibold text-gray-900 dark:text-white">Monthly Salary</p>
                        <p class="text-xs text-gray-500 dark:text-[color:var(--muted)]">Income ・ Yesterday</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-4 text-sm text-gray-600 dark:text-[color:var(--muted)]">Income</td>
                  <td class="px-4 py-4 text-right font-semibold text-green-600">+$2,500.00</td>
                  <td class="px-4 py-4 text-sm text-gray-500 dark:text-[color:var(--muted)]">Dec 2, 2025</td>
                </tr>

                <tr class="border-t border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                  <td class="px-4 py-4">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 rounded-lg bg-[color:var(--accent-light)]/10 dark:bg-[color:var(--accent-dark-from)]/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[color:var(--accent-light)] dark:text-white text-sm">movie</span>
                      </div>
                      <div>
                        <p class="font-semibold text-gray-900 dark:text-white">Netflix Subscription</p>
                        <p class="text-xs text-gray-500 dark:text-[color:var(--muted)]">Entertainment ・ Oct 28</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-4 text-sm text-gray-600 dark:text-[color:var(--muted)]">Entertainment</td>
                  <td class="px-4 py-4 text-right font-semibold text-red-500">-$15.49</td>
                  <td class="px-4 py-4 text-sm text-gray-500 dark:text-[color:var(--muted)]">Oct 28, 2025</td>
                </tr>

                <!-- add 3–4 sample rows total (FR: these are static examples; replace with PHP loop) -->
              </tbody>
            </table>
          </div>

        </section>

        <!-- Spacer bottom -->
        <div class="h-24"></div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-100 dark:border-gray-800 bg-white/60 dark:bg-black/40">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 text-center text-sm text-gray-500 dark:text-[color:var(--muted)]">
        © 2025 FinanceApp. All Rights Reserved. <a href="#" class="text-[color:var(--accent-light)] hover:underline">Privacy Policy</a>
      </div>
    </footer>

    <!-- Floating Action Button (kept behavior) -->
    <div class="fixed bottom-6 right-6">
      <button aria-label="Add new" data-action="open-add" class="w-14 h-14 rounded-full shadow-lg transform hover:scale-105 transition"
              style="background: linear-gradient(90deg,var(--accent-light),#4f46e5); color: white;">
        <span class="material-symbols-outlined" style="font-size: 28px;">add</span>
      </button>
    </div>

    <!-- Modal (Add) - hidden by default -->
    <div id="modal-income" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
  <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" data-action="close" data-target="modal-income"></div>
  <div class="relative w-full max-w-lg rounded-2xl bg-[color:var(--card-bg)] p-6 shadow-lg border border-gray-100 dark:border-gray-800">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add income</h3>
      <button class="p-2 rounded-md" data-action="close" data-target="modal-income"><span class="material-symbols-outlined">close</span></button>
    </div>
        <!-- FR comment: Form fields — keep same names as backend expects -->
        <form method="POST" action="traitement.php" class="grid grid-cols-1 gap-3">
          <div>
            <label class="text-sm text-gray-600 dark:text-[color:var(--muted)]">Date</label>
            <input type="date" name="date_inc" class="mt-1 w-full rounded-xl border border-gray-200 px-3 py-2 focus-ring" required />
          </div>
          <div>
            <label class="text-sm text-gray-600 dark:text-[color:var(--muted)]">Amount</label>
            <input type="number" name="amount_inc" step="0.01" class="mt-1 w-full rounded-xl border border-gray-200 px-3 py-2 focus-ring" required />
          </div>
          <div>
            <label class="text-sm text-gray-600 dark:text-[color:var(--muted)]">Descreption</label>
            <textarea type ="text" name="descreption_inc" class="h-20 w-full rounded-xl border border-gray-200 px-3 py-2 focus-ring" required ></textarea>
            </div>
          <div class="flex gap-2">
            <button type="submit"  name="save_inc" class="flex-1 px-4 py-2 rounded-xl text-white" style="background: linear-gradient(90deg,var(--accent-light),#4f46e5);">Save</button>
          </div>
        </form>
      </div>
    </div>
    <!--  modal de nex expenses  !-->
    <div  id="modal-expense" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
  <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" data-action="close" data-target="modal-expense"></div>
  <div class="relative w-full max-w-lg rounded-2xl bg-[color:var(--card-bg)] p-6 shadow-lg border border-gray-100 dark:border-gray-800">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add expense</h3>
      <button class="p-2 rounded-md" data-action="close" data-target="modal-expense"><span class="material-symbols-outlined">close</span></button>
    </div>
        <!-- FR comment: Form fields — keep same names as backend expects -->
        <form method="POST" action="traitement.php" class="grid grid-cols-1 gap-3">
          <div>
            <label class="text-sm text-gray-600 dark:text-[color:var(--muted)]">Date</label>
            <input type="date" name="date_exp" class="mt-1 w-full rounded-xl border border-gray-200 px-3 py-2 focus-ring" required />
          </div>
          <div>
            <label class="text-sm text-gray-600 dark:text-[color:var(--muted)]">Amount</label>
            <input type="number" name="amount_exp" step="0.01" class="mt-1 w-full rounded-xl border border-gray-200 px-3 py-2 focus-ring" required />
          </div>
          <div>
            <label class="text-sm text-gray-600 dark:text-[color:var(--muted)]">Descreption</label>
            <textarea type ="text" name="descreption_exp" class="h-20 w-full rounded-xl border border-gray-200 px-3 py-2 focus-ring" required ></textarea>
            </div>
          <div class="flex gap-2">
            <button type="submit"  name="save_exp" class="flex-1 px-4 py-2 rounded-xl text-white" style="background: linear-gradient(90deg,var(--accent-light),#4f46e5);">Save</button>
          </div>
        </form>
      </div>
    </div>


  </div>

</body>
</html>
