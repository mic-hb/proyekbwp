import GeneralLayout from "@/layouts/general";
import Search from "@/components/filter";

export default function index() {
    return (
        <GeneralLayout>
            <div className="flex flex-col">
                <Search />
            </div>
        </GeneralLayout>
    );
}
