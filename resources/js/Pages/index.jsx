import GeneralLayout from "@/layouts/general";
import Search from "@/components/filter";
import React from "react";
import {
    Navbar,
    NavbarBrand,
    NavbarCollapse,
    NavbarLink,
    NavbarToggle,
} from "flowbite-react";
export default function index() {
    return (
        <GeneralLayout>
            <div className="flex flex-col">
                <Search />
            </div>
        </GeneralLayout>
    );
}
