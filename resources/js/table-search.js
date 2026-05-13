// Reusable table search function
function setupTableSearch(searchInputId, tableSelector) {
    const searchInput = document.getElementById(searchInputId);
    const tableBody = document.querySelector(tableSelector + ' tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        rows.forEach(row => {
            // Get all cells except the last one (Actions column)
            const cells = Array.from(row.cells).slice(0, -1);
            const rowText = cells.map(cell => cell.textContent.toLowerCase()).join(' ');

            if (rowText.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
}

// Reusable table sorting function
function setupTableSorting(tableSelector) {
    const table = document.querySelector(tableSelector);
    if (!table) {
        return;
    }

    const tableBody = table.querySelector('tbody');
    const sortableHeaders = Array.from(table.querySelectorAll('.sortable'));

    sortableHeaders.forEach(header => {
        header.addEventListener('click', function () {
            const currentSort = this.dataset.sort || 'asc';
            const newSort = currentSort === 'asc' ? 'desc' : 'asc';
            const columnIndex = this.cellIndex;

            sortableHeaders.forEach(h => {
                if (h !== this) {
                    delete h.dataset.sort;
                    const hIcon = h.querySelector('i');
                    if (hIcon) {
                        hIcon.className = 'bi bi-arrow-down-up';
                    }
                }
            });

            this.dataset.sort = newSort;
            const icon = this.querySelector('i');
            if (icon) {
                icon.className = newSort === 'asc' ? 'bi bi-arrow-up-short' : 'bi bi-arrow-down-short';
            }

            const rows = Array.from(tableBody.querySelectorAll('tr'));

            const sortedRows = rows.sort((a, b) => {
                const aValue = getCellText(a, columnIndex);
                const bValue = getCellText(b, columnIndex);
                const aNumber = parseFloat(aValue);
                const bNumber = parseFloat(bValue);
                const isNumeric = !Number.isNaN(aNumber) && !Number.isNaN(bNumber);

                const first = isNumeric ? aNumber : aValue;
                const second = isNumeric ? bNumber : bValue;

                if (first === second) {
                    return 0;
                }

                if (newSort === 'asc') {
                    return first > second ? 1 : -1;
                }

                return first < second ? 1 : -1;
            });

            sortedRows.forEach(row => tableBody.appendChild(row));
        });
    });

    function getCellText(row, index) {
        const cell = row.cells[index];
        return cell ? cell.textContent.trim().toLowerCase() : '';
    }
}
