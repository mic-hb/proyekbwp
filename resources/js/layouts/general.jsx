import NavBar from "@/components/NavBar";
import Footer from "@/components/footer";
import Spinner from "@/components/spinner";

export default function GeneralLayout({ children, isLoading }) {
    return (
        <div className="min-h-screen flex flex-col justify-between">
            <NavBar />
            <div className="max-w-screen-lg container mx-auto px-4 py-8 flex flex-col justify-center items-center">
                {isLoading ? <Spinner /> : children}
            </div>
            <Footer />
        </div>
    );
}
