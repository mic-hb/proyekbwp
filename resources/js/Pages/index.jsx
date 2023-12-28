import GeneralLayout from "@/layouts/GeneralLayout";

export default function index() {
    return (
        <GeneralLayout>
            <div className="flex flex-col items-center justify-center">
                <h1 className="text-5xl font-bold text-center">
                    Welcome to Flowbite React
                </h1>
                <p className="text-xl text-center mt-4">
                    This is a starter template for a React application using
                    Flowbite React components.
                </p>
            </div>
        </GeneralLayout>
    );
}
