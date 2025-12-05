<?php
require_once('config.php');
?>

<!DOCTYPE html>
<html lang="en" class="light">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Incomes Management — Your Smart Wallet</title>

  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: { display: ['Manrope', 'sans-serif'] },
          colors: {
            primary: '#2563eb',
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
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    :root { --card-bg: #ffffff; --bg: #f6f8f7; --muted: #6b7280; --accent-light: #2563eb; }
    .dark { --card-bg: #0f1720; --bg: #0b1210; --muted: #9db8a8; --accent-dark-from: #7c3aed; --accent-dark-to: #ec4899; }
    :focus { outline: 2px solid transparent; outline-offset: 2px; }
    .focus-ring:focus { box-shadow: 0 0 0 4px rgba(37,99,235,0.12); border-color: rgba(37,99,235,0.6); }
    body { min-height: 100vh; }
  </style>
</head>
<body class="font-display text-gray-800 bg-[color:var(--bg)] dark:bg-[color:var(--bg)]">

  <script>
    window.uiTheme = {
      toggle: function() {
        const root = document.documentElement;
        const isDark = root.classList.toggle('dark');
        root.classList.toggle('light', !isDark);
        localStorage.setItem('ui-theme', isDark ? 'dark' : 'light');
        const icon = document.querySelector("[data-action='toggle-theme'] span");
        if(icon) icon.textContent = isDark ? 'dark_mode' : 'light_mode';
      }
    };

    (function(){
      const saved = localStorage.getItem('ui-theme') ||
            (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
      if(saved === 'dark') document.documentElement.classList.add('dark'); 
      else document.documentElement.classList.add('light');
    })();

    document.addEventListener("click", function(e){
      const el = e.target.closest("[data-action]");
      if(!el) return;
      const action = el.dataset.action;
      if(action==='toggle-theme') window.uiTheme.toggle();
    });
  </script>

  <div class="min-h-screen flex flex-col">

    <header class="sticky top-0 z-30 backdrop-blur-sm bg-white/60 dark:bg-black/40 border-b border-gray-200 dark:border-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
          <div></div>
          <div class="flex items-center">
            <span class="font-bold text-3xl text-[color:var(--accent-light)] dark:text-transparent bg-clip-text dark:bg-gradient-to-r dark:from-[color:var(--accent-dark-from)] dark:to-[color:var(--accent-dark-to)]">
              Your Smart Wallet
            </span>
          </div>
          <div class="flex items-center gap-3">
            <button data-action="toggle-theme" aria-label="Toggle theme" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/6 focus-ring">
              <span class="material-symbols-outlined">light_mode</span>
            </button>
          </div>
        </div>
      </div>
    </header>

    <main class="flex-1">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="mb-6">
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Incomes Management</h1>
          <p class="mt-2 text-sm text-gray-500 dark:text-[color:var(--muted)]">View and manage all your income transactions</p>
        </div>

        <section class="rounded-2xl p-6 bg-[color:var(--card-bg)] border border-gray-100 dark:border-gray-800 shadow-subtle">
          
          <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">All Incomes</h2>
            <div class="flex gap-2">
              <a href="index.php">
                <button class="flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-[color:var(--muted)] hover:bg-gray-50 dark:hover:bg-white/5 transition">
                  <span class="material-symbols-outlined text-sm">arrow_back</span>
                  <span class="hidden sm:inline">Back to Dashboard</span>
                </button>
              </a>
            </div>
          </div>
          <div class="overflow-x-auto -mx-6 px-6">
            <table class="w-full text-left">
              <thead class="sticky top-0 bg-white dark:bg-[color:var(--card-bg)]">
                <tr class="border-b border-gray-200 dark:border-gray-800">
                  <th class="px-4 py-4 text-sm font-semibold text-gray-600 dark:text-[color:var(--muted)]">ID</th>
                  <th class="px-4 py-4 text-sm font-semibold text-gray-600 dark:text-[color:var(--muted)]">Amount</th>
                  <th class="px-4 py-4 text-sm font-semibold text-gray-600 dark:text-[color:var(--muted)]">Description</th>
                  <th class="px-4 py-4 text-sm font-semibold text-gray-600 dark:text-[color:var(--muted)]">Date</th>
                  <th class="px-4 py-4 text-sm font-semibold text-gray-600 dark:text-[color:var(--muted)] text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($result_incomes as $row): ?>
                  <tr class="border-t border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                    <td class="px-4 py-4 text-gray-700 dark:text-gray-300">
                      <span class="font-medium">#<?= $row['id'] ?></span>
                    </td>
                    <td class="px-4 py-4">
                      <span class="font-bold text-green-600 dark:text-green-400">
                        +$<?= number_format($row['montant'], 2) ?>
                      </span>
                    </td>
                    <td class="px-4 py-4 text-gray-700 dark:text-gray-300">
                      <p class="max-w-xs truncate"><?= htmlspecialchars($row['descreption']) ?></p>
                    </td>
                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-[color:var(--muted)]">
                      <?= date('M d, Y', strtotime($row['la_date'])) ?>
                    </td>
                    <td class="px-4 py-4">
                      <div class="flex justify-end gap-2">
                        <!-- Edit Button -->
                        <a href="edit_inc.php?id=<?= $row['id'] ?>">
                          <button class="flex items-center gap-1 px-3 py-2 rounded-lg text-white bg-[color:var(--accent-light)] hover:opacity-90 transition shadow-sm">
                            <span class="material-symbols-outlined text-sm">edit</span>
                            <span class="hidden sm:inline text-sm">Edit</span>
                          </button>
                        </a>

                        <!-- Delete Button -->
                        <a href="delete_inc.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this income record?');">
                          <button class="flex items-center gap-1 px-3 py-2 rounded-lg text-white bg-red-600 hover:bg-red-700 transition shadow-sm">
                            <span class="material-symbols-outlined text-sm">delete</span>
                            <span class="hidden sm:inline text-sm">Delete</span>
                          </button>
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php if(empty($result_incomes)): ?>
            <div class="py-12 text-center">
              <span class="material-symbols-outlined text-6xl text-gray-300 dark:text-gray-700">inbox</span>
              <p class="mt-4 text-gray-500 dark:text-[color:var(--muted)]">No income records found</p>
              <a href="index.php">
                <button class="mt-4 px-6 py-2 rounded-xl text-white" style="background: linear-gradient(90deg,var(--accent-light),#4f46e5);">
                  Add Your First Income
                </button>
              </a>
            </div>
          <?php endif; ?>

        </section>

      </div>
    </main>
    <footer class="border-t border-gray-100 dark:border-gray-800 bg-white/60 dark:bg-black/40 mt-auto">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 text-center text-sm text-gray-500 dark:text-[color:var(--muted)]">
        © 2025 FinanceApp. All Rights Reserved. 
      </div>
    </footer>

  </div>

</body>
</html>