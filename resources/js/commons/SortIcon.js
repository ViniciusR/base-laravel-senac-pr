class SortIcon {
    constructor() {
        this.order = 'desc';
    }

    getArrowUpClass() {
        return 'fa fa-sort-up ml-2';
    }

    getArrowDownClass() {
        return 'fa fa-sort-down ml-2';
    }

    getSortClass() {
        return 'fa fa-sort ml-2';
    }

    getArrowClass() {
        return this.order === 'asc' ?
            this.getArrowUpClass() :
            this.getArrowDownClass();
    }

    getFaElement(id) {
        let arrow = document.createElement('i');
        arrow.setAttribute("id", 'i_'+id);
        arrow.className = this.getSortClass();

        return arrow;
    }

    getAllIcons() {
        return document.querySelectorAll('th[sortable]');
    }

    setArrow() {
        this.getAllIcons().forEach((node) => {
            node.appendChild(this.getFaElement(node.id));
        });
    }

    setToggleOrder() {
        this.order = (this.order === 'asc') ? 'desc' : 'asc';
    }

    updateSortClass(element) {
        const i = element.childNodes[1];
        
        if (i != undefined) {
            i.className = this.getArrowClass();
        }
    }

    updateAllSortClass() {
        this.getAllIcons().forEach((node) => {
            this.updateSortClass(node, this.getSortClass());
        });
    }

    change(event) {
        const target = event.target;

        this.updateAllSortClass();
        this.setToggleOrder();
        this.updateSortClass(target);
    }
}

export default SortIcon;
