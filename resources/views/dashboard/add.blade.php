<x-app-layout>
@section('title', 'Add Product | Dashboard | GS')
    @include('dashboard.nav')
    <div class="content-container">
        <div class="heading-container">
            <h1>Add New Product</h1>
            <div class="button-section">
                <button class="discard-button">Discard</button>
                <button class="save-button">Save Changes</button>               
            </div>    
        </div>
        <div class="layer">
            <div class="main-container">
                <h1>Product Title</h1>
                <input id="title" class="input1">

                <h1>Product Description</h1>
                <textarea id="desc" class="input2"></textarea>

                <h1>Youtube Tailer</h1>
                <input id="title" class="input1">

                <h1>Extra Description</h1>
                <textarea id="desc" class="input3"></textarea>

                <h2 class="system-heading">System Requirement Form</h2>
                <div class="system">
                    <div style="position: relative;">
                        <label for="os-min">OS Minimun</label>
                        <input id="os-min">

                        <label for="os-rec">OS Recommended</label>
                        <input id="os-rec">
                    </div>
                    <div style="position: relative;">
                        <label for="os-min">CPU Minimun</label>
                        <input id="os-min">

                        <label for="os-rec">CPU Recommended</label>
                        <input id="os-rec">
                    </div>
                    <div style="position: relative;">
                        <label for="os-min">Ram Minimun</label>
                        <input id="os-min">

                        <label for="os-rec">Ram Recommended</label>
                        <input id="os-rec">
                    </div>
                    <div style="position: relative;">
                        <label for="os-min">GPU Minimun</label>
                        <input id="os-min">

                        <label for="os-rec">GPU Recommended</label>
                        <input id="os-rec">
                    </div>
                    <div style="position: relative;">
                        <label for="os-min">Storage Minimun</label>
                        <input id="os-min">

                        <label for="os-rec">Storage Recommended</label>
                        <input id="os-rec">
                    </div>

                </div>



            </div>
        <div class="side-container">
            <div style="display:flex; justify-content:center; gap:1vw;">
                <div class="input-type1">
                    <label for="price">Price</label>
                    <input type="text" id="price" name="price">
                </div>
                <div class="input-type1">
                    <label for="quantity">Quantity</label>
                    <input type="text" id="quantity" name="quantity">
                </div>
            </div>

            <div class="input-type1">
                <label for="release">Release date</label>
                <input style="padding-right: 1vw;  width: 6.5vw;" type="date" id="release" name="release">
            </div>

            <div style="display:flex; justify-content:center; gap:1vw;">
                <div class="input-type1">
                    <label for="platform">Platform</label>
                    <input type="text" id="platform" name="platform">
                </div>
                <div class="input-type1">
                    <label for="genre">Genre</label>
                    <input type="text" id="genre" name="genre">
                </div>
            </div>

            <div style="display:flex; justify-content:center; gap:1vw;">
                <div class="input-type1">
                    <label for="developer">Developer</label>
                    <input type="text" id="developer" name="developer">
                </div>
                <div class="input-type1">
                    <label for="publisher">Publisher</label>
                    <input type="text" id="publisher" name="publisher">
                </div>
            </div>

            <div style="display:flex; justify-content:center; gap:1vw;">
                <div class="input-type1">
                    <label for="cover">Cover</label>
                    <input type="text" id="cover" name="cover">
                </div>
                <div class="input-type1">
                    <label for="image">Screenshot</label>
                    <input type="text" id="image" name="image">
                </div>
            </div>
            <div style="display:flex; gap:1.5vw;">
                <div class="input-type2">
                    <h3>Featured</h3>
                    <input type="checkbox" id="feature" name="feature">
                </div>
                <div class="input-type2">
                    <h3>Top Sale</h3>
                    <input type="checkbox" id="top" name="top">
                </div>
            </div>

            <div style="display:flex; gap:1.5vw;">
                <div class="input-type2">
                    <h3>On Sale</h3>
                    <input type="checkbox" id="sale" name="sale">
                    <input class="text" type="date" id="sale_date" name="sale_date">
                    <input class="text" type="number" id="sale_pre" name="sale_pre">
                </div>
            </div>
            <div style="display:flex; gap:1.5vw;">
                <div class="input-type2">
                    <h3>Coming Soon</h3>
                    <input type="checkbox" id="coming" name="coming">
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>