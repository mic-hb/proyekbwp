import React from "react";
import { Button, Checkbox, Label, TextInput } from "flowbite-react";
import GeneralLayout from "@/layouts/general";

export default function register() {
    return (
        <GeneralLayout>
            <form className="flex max-w-xl w-full flex-col gap-4">
                <div>
                    <div className="mb-2 block">
                        <Label htmlFor="email2" value="Your email" />
                    </div>
                    <TextInput
                        id="email2"
                        type="email"
                        placeholder="name@flowbite.com"
                        required
                        shadow
                    />
                </div>
                <div>
                    <div className="mb-2 block">
                        <Label htmlFor="password2" value="Your password" />
                    </div>
                    <TextInput id="password2" type="password" required shadow />
                </div>
                <div>
                    <div className="mb-2 block">
                        <Label htmlFor="repeat-password" value="Repeat password" />
                    </div>
                    <TextInput
                        id="repeat-password"
                        type="password"
                        required
                        shadow
                    />
                </div>
                <div className="flex items-center gap-2">
                    <Checkbox id="agree" />
                    <Label htmlFor="agree" className="flex">
                        I agree with the&nbsp;
                        <a
                            href="#"
                            className="text-cyan-600 hover:underline dark:text-cyan-500"
                        >
                            terms and conditions
                        </a>
                    </Label>
                </div>
                <Button type="submit">Register new account</Button>
            </form>
        </GeneralLayout>
    );
}
